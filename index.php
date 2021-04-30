<?php

use App\App\Pre;
use App\App\Router;

require __DIR__.'/vendor/autoload.php';

session_start();
//Seta as variáveis do .env
\App\App\Environment::load(__DIR__);

define('URL', getenv('URL'));

$router = new Router(URL);

include __DIR__ . '/routes/routes.php';


$router->run()->sendResponse();

