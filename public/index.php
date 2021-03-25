<?php

require __DIR__.'/../vendor/autoload.php';
include __DIR__.'/../database/connectionInitial.php';

use \Kabum\App\Router;


$route = new Router();
$GLOBALS['router']  = $route;
$dataConnection = include __DIR__ . '/../routes/routes.php';

//echo '<pre>';
//var_dump($_SERVER);
////var_dump($route->routes);
//echo '</pre>';
//exit;
$route->redirect();
