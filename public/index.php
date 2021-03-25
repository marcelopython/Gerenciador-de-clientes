<?php

require __DIR__.'/../vendor/autoload.php';

use \DB\Database\Connection;
use \Kabum\App\Router;

$dataConnection = include __DIR__ . '/../config/database.php';
define('HOST', $dataConnection['host']);
define('DBNAME', $dataConnection['database']);
define('CHARSET', $dataConnection['charset']);
define('USER', $dataConnection['user']);
define('PASSWORD', $dataConnection['password']);
define('PORT', $dataConnection['port']);

Connection::connect();

$route = new Router();
$GLOBALS['router']  = $route;
$dataConnection = include __DIR__ . '/../routes/routes.php';

//echo '<pre>';
//var_dump($_SERVER);
////var_dump($route->routes);
//echo '</pre>';
//exit;
$route->redirect();
