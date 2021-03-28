<?php

namespace Kabum\App;

use Kabum\App\Contracts\RouterInterface;

/**
 * Class Router
 * @package Kabum\App
 * Classe responsável por chamar o controller da requisiçao
 */
class Router extends Request implements RouterInterface
{
    private array $routes = [];

    private array $methodsForCsrf = ['POST'=>'POST'];

    /**
     *Buscar arquivos staticos css, js ....
     */
    public function asset(string $path): string
    {
        $paths = explode('/', $this->scriptName);
        $indexFile = array_search('index.php', $paths);
        if($indexFile !== false){
            unset($paths[$indexFile]);
            return join('/',$paths).$path;
        }
    }

    private function setRoute(array $route)
    {
        $this->routes = array_merge($this->routes, $route);
    }

    /**
     *Metodo para requisiçao http GET
     */
    public function get($url, $controller = [], \Closure $closure = null): Router
    {
        $this->setRoute([['method'=>'GET', $url, !empty($controller) ? $controller : $closure, 'data_request'=>$_GET]]);
        return $this;
    }

    /**
     *Metodo para requisiçao http POST
     */
    public function post($url, $controller = []): Router
    {
        $this->setRoute([['method'=>'POST',$url, $controller, 'data_request'=>$_POST]]);
        return $this;
    }

    /**
    *Metodo para setar o middlewware nas rotas selecionadas
     */
    public function middleware(array $middlewares, \Closure $func)
    {
        $urlsInMiddleware = $func();
        foreach($this->routes as $key => $route){
            foreach($urlsInMiddleware as $url) {
                if($route[0] === $url){
                    $this->routes[$key]['middleware'] = $middlewares;
                }
            }
        }
    }

    /**
     * Inicia a buscar o controller da requisiçao
     */
    public function run()
    {
        $pathInfoItems = explode('/', $this->server['PATH_INFO'] ?? $this->server['REQUEST_URI']);
        $parameters = [];
        foreach($this->routes as $route){
            $this->getParameters($route, $pathInfoItems, $parameters);
            if($this->httpHost.$this->scriptName.$route[0]  === $this->httpHost.$this->requestSelf && $this->method === $route['method']){
                if(!empty($this->methodsForCsrf[$this->method])){
                    if(empty($route['data_request']['_token']) || Csrf::csrf() !== $route['data_request']['_token']){
                        $this->redirectTo('http/401', 401);
                        return ViewHTML::view('http/401');
                    }
                    unset($route['data_request']['_token']);
                }
                $request = array_merge($this->server, ['data_request' => $route['data_request']]);
                Csrf::setCsrf();
                if($route[1] instanceof \Closure){
                    return $route[1]($request);
                }
                return $this->getController($route, $request, $parameters);
            }
        }
        return ViewHTML::view('http/404');
    }

    /**
     * Obtem o controller da requisiçao
     */
    public function getController(array $route, array $request, array $parameters)
    {
        $controller = $route[1][0];
        $method = $route[1][1];
        if(!isset($route['middleware'])){
            return (new $controller())->$method($request, ...$parameters);
        }else{
            foreach($route['middleware'] as $middleware){
                $request = (new $middleware())->middleware($request, function($request){return $request;});
                if(!$request){
                    $this->redirectTo('login');
                }
            }
            return (new $controller())->$method($request, ...$parameters);
        }
    }

    /**
     * Pega o parametro esquecificado na configuraçao de rotas por default o coringa  e [$parametro]
     * ex: /customer/delete/[$id]
     */
    public function getParameters(array &$route, array $pathInfoItems, array &$parameters)
    {

        if (strpos($route[0], '[$')) {
            $pathWithParameters = explode('/', $route[0]);
            foreach($pathWithParameters as $key => $path){
                if(empty($pathInfoItems[$key])){
                    return;
                }
                if (strpos($pathInfoItems[$key], '[$') !== false) {
                    continue;
                }
                if ($pathInfoItems[$key] !== $path) {
                    return;
                }
            }
            foreach ($pathWithParameters as $key => $value) {
                if (array_search($value, $pathInfoItems) === false) {
                    $this->validateTypeParameters($pathInfoItems[$key]);
                    $parameters[] = $pathInfoItems[$key];
                }
                $pathWithParameters[$key] = $pathInfoItems[$key];
            }
            $route[0] = join('/', $pathWithParameters);
        }

    }
    /**
     * Valida o tipo de parametro setado na url
     * */
    public function validateTypeParameters($param)
    {
        foreach ($this->type as $type) {
            switch($type) {
                case 'int':
                    if(!is_numeric($param)){
                        return ViewHTML::view('http/404');
                    }
                    break;
            }
        }
    }

    public function type(array $type = [])
    {
        $this->type = $type;
    }

    public function redirectTo($uri, $code = 302): void
    {
        header('Location: '.$this->protocol.$this->httpHost.$this->scriptName.'/'.$uri, false, $code);
    }
}