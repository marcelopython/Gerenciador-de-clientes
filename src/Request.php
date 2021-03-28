<?php


namespace Kabum\App;


abstract class Request
{
    protected string $uri;

    protected string  $httpHost;

    protected array $server;

    protected string $method;

    protected string $scriptName;

    protected string $protocol;

    protected array $type = [];

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->httpHost = $_SERVER['HTTP_HOST'];
        $this->server = $_SERVER;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->scriptName = $_SERVER['SCRIPT_NAME'];
        $this->protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
        Csrf::setCsrf();
    }
}