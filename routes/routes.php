<?php
use \Kabum\App\Router;

$route = new Router();
$GLOBALS['router']  = $route;

$route->get('/', [], function() use ($route){
    $route->redirectTo('login');
});

$route->get('', [], function() use ($route){
    $route->redirectTo('login');
});

$route->get('/login', [\Kabum\App\Controller\Auth\LoginController::class, 'loginForm']);
$route->post('/login', [\Kabum\App\Controller\Auth\LoginController::class, 'login']);

$route->middleware([\Kabum\App\Middleware\AuthMiddleware::class], function() use ($route){
    $route->get('/dashboard', [\Kabum\App\Controller\Dashboard\DashboardController::class, 'index']);

    /*Rotas de clientes*/
    $route->get('/customer', [\Kabum\App\Controller\Customer\CustomerController::class, 'index']);
    $route->get('/customer/create', [\Kabum\App\Controller\Customer\CustomerController::class, 'form']);
    $route->post('/customer/create', [\Kabum\App\Controller\Customer\CustomerController::class, 'create']);

    $route->get('/customer/edit/[int:$id]', [\Kabum\App\Controller\Customer\CustomerController::class, 'edit']);

    /*Rotas de endereço*/
//    $route->get('/form-address/<int: index>', [\Kabum\App\Controller\Address\AddressController::class, 'formAdd']);

    return ['/dashboard', '/customer', '/logout', '/customer/create'];
});

$route->run();


