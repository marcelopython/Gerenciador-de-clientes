<?php

namespace Kabum\App;

class Router{

    private array $routes = [];

    private string $uri;

    private string  $httpHost;

    private array $server;

    private string $method;

    private string $scriptName;

    private string $protocol;

    private $next;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
//        echo '<pre>';
//        var_dump($_SERVER);
//        exit;
        $this->httpHost = $_SERVER['HTTP_HOST'];
        $this->server = $_SERVER;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->scriptName = $_SERVER['SCRIPT_NAME'];
        $this->protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
    }

    private function setRoute($route)
    {
        $this->routes = array_merge($this->routes, $route);
    }

    public function get($url, $controller = []): Router
    {
        $this->setRoute([['method'=>'GET', $url, $controller, 'data_request'=>$_GET]]);
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

    public function redirect()
    {
        foreach($this->routes as $route){
            if($this->httpHost.$this->scriptName.$route[0]  === $this->httpHost.$this->uri && $this->method === $route['method']){
                $controller = $route[1][0];
                $method = $route[1][1];
                $request = array_merge($this->server, ['data_request' => $route['data_request']]);
                if(!isset($route['middleware'])){
                    return (new $controller())->$method($request);
                }else{
                    foreach($route['middleware'] as $middleware){
                        $request = (new $middleware())->middleware($request, function($request){return $request;});
                        if(!$request){
                            return $this->redirectTo('login');
                        }else{
                            (new $controller())->$method($request);
                        }
                    }
                }
            }
        }
        return ViewHTML::view('http/404');
    }

    private function next(array $request)
    {
        return $request;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function redirectTo($uri)
    {
        return header('Location: '.$this->protocol.$this->httpHost.$this->scriptName.'/'.$uri);
    }

}