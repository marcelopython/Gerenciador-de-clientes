<?php
use \Kabum\App\Router;
use \Kabum\App\Controller\Customer\CustomerController;

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
    $route->get('/customer', [CustomerController::class, 'index']);
    $route->get('/customer/create', [CustomerController::class, 'form']);
    $route->post('/customer/create', [CustomerController::class, 'create']);
    $route->get('/customer/edit/[$id]', [CustomerController::class, 'edit'])->type(['int']);
    $route->post('/customer/update/[$id]', [CustomerController::class, 'update'])->type(['int']);

    return [
        '/dashboard', '/customer', '/logout', '/customer/create', '/customer/edit/[$id]', '/customer/update/[$id]'
    ];
});

$route->run();


