<?php

namespace Kabum\App;

use Kabum\App\Contracts\RouterInterface;

class Router implements RouterInterface
{

    private array $routes = [];

    private string $uri;

    private string  $httpHost;

    private array $server;

    private string $method;

    private string $scriptName;

    private string $protocol;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->httpHost = $_SERVER['HTTP_HOST'];
        $this->server = $_SERVER;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->scriptName = $_SERVER['SCRIPT_NAME'];
        $this->protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
    }

    public function asset(string $path)
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

    public function get($url, $controller = [], \Closure $closure = null): Router
    {
        $this->setRoute([['method'=>'GET', $url, !empty($controller) ? $controller : $closure, 'data_request'=>$_GET]]);
        return $this;
    }

    public function post($url, $controller = []): Router
    {
        $this->setRoute([['method'=>'POST',$url, $controller, 'data_request'=>$_POST]]);
        return $this;
    }

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

    public function run()
    {
        foreach($this->routes as $route){
            if($this->httpHost.$this->scriptName.$route[0]  === $this->httpHost.$this->uri && $this->method === $route['method']){
                $request = array_merge($this->server, ['data_request' => $route['data_request']]);
                if($route[1] instanceof \Closure){
                    return $route[1]($request);
                }
                $controller = $route[1][0];
                $method = $route[1][1];
                if(!isset($route['middleware'])){
                    return (new $controller())->$method($request);
                }else{
                    foreach($route['middleware'] as $middleware){
                        $request = (new $middleware())->middleware($request, function($request){return $request;});
                        if(!$request){
                            return $this->redirectTo('login');
                        }
                    }
                    return (new $controller())->$method($request);
                }
            }
        }
        return ViewHTML::view('http/404');
    }

    public function redirectTo($uri)
    {
        return header('Location: '.$this->protocol.$this->httpHost.$this->scriptName.'/'.$uri);
    }

}