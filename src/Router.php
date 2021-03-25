<?php

namespace Kabum\App;

class Router{

    private array $routes = [];

    private $uri;

    private $httpHost;

    private $server;

    private $method;

    private $scriptName;

    private $protocol;

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

    public function get($url, $controller = [])
    {
        $this->routes = array_merge($this->routes, [
            ['method'=>'GET', $url, $controller, 'data_request'=>$_GET]
        ]);
        return $this;
    }

    public function post($url, $controller = [])
    {
        $this->routes = array_merge($this->routes, [
            ['method'=>'POST',$url, $controller, 'data_request'=>$_POST]
        ]);
        return $this;
    }

    public function redirect()
    {
        foreach($this->routes as $route){
            if($this->httpHost.$this->scriptName.$route[0]  === $this->httpHost.$this->uri && $this->method === $route['method']){
                $controller = $route[1][0];
                $method = $route[1][1];
                return (new $controller())->$method(array_merge($this->server, ['data_request'=>$route['data_request']]));
            }
        }
        return ViewHTML::view($this->protocol.'404');
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function redirectTo($uri)
    {
        return header('Location: '.$this->protocol.$this->httpHost.$this->scriptName.'/'.$uri);
    }

}