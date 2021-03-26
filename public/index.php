<?php

require __DIR__.'/../vendor/autoload.php';
include __DIR__.'/../database/connectionInitial.php';

use \Kabum\App\Router;
session_start();


$route = new Router();
$GLOBALS['router']  = $route;
$dataConnection = include __DIR__ . '/../routes/routes.php';

$route->redirect();
