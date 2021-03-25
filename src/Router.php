<?php

namespace Kabum\App;

class Router{

    private array $routes = [];

    private $uri;

    private $httpHost;

    private $server;

    private $method;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->httpHost = $_SERVER['HTTP_HOST'];
        $this->server = $_SERVER;
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function get($url, $controller = [])
    {
        $this->routes = array_merge($this->routes, [
            ['method'=>'GET', $this->httpHost.$url, $controller, 'data_request'=>$_GET]
        ]);
        return $this;
    }

    public function post($url, $controller = [])
    {
        $this->routes = array_merge($this->routes, [
            ['method'=>'POST',$this->httpHost.$url, $controller, 'data_request'=>$_POST]
        ]);
        return $this;
    }

    public function redirect()
    {
        foreach($this->routes as $route){
            if($route[0] === $this->httpHost.$this->uri.'/' && $this->method === $route['method']){
                $controller = $route[1][0];
                $method = $route[1][1];
                (new $controller())->$method(array_merge($this->server, ['data_request'=>$route['data_request']]));
                exit;
            }
        }
        return ViewHTML::view('http/404');
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function redirectTo($uri)
    {
        header('Location: ' . 'http://localhost:8000/'.$uri);
    }

}