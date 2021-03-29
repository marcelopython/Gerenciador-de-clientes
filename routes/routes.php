<?php


/**
 * Configuração de rotas
 * */

use \Kabum\App\Router;
use \Kabum\App\Controller\Customer\CustomerController;
use \Kabum\App\Controller\Auth\LoginController;
$route = new Router();

/**
 * Rotas publicas
 */
$route->get('/', [], function() use ($route){$route->redirectTo('login');});
$route->get('', [], function() use ($route){$route->redirectTo('login');});
$route->get('/login', [LoginController::class, 'loginForm']);
$route->post('/login', [LoginController::class, 'login']);

/***
 * Middleware de verificação da autenticação do usuario
 */
$route->middleware([\Kabum\App\Middleware\AuthMiddleware::class], function() use ($route){

    $route->get('/dashboard', [\Kabum\App\Controller\Dashboard\DashboardController::class, 'index']);
    $route->post('/logout', [\Kabum\App\Controller\Auth\LogoutController::class, 'logout']);

    /*Rotas de clientes*/
    $route->get('/customer', [CustomerController::class, 'index']);
    $route->get('/customer/create', [CustomerController::class, 'form']);
    $route->post('/customer/create', [CustomerController::class, 'create']);
    $route->get('/customer/edit/[$id]', [CustomerController::class, 'edit'])->type(['int']);
    $route->post('/customer/update/[$id]', [CustomerController::class, 'update'])->type(['int']);
    $route->post('/customer/delete/[$id]', [CustomerController::class, 'delete'])->type(['int']);

    /**
     * Rotas para usar o(s) middleware
     * */
    return [
        '/dashboard', '/customer', '/logout', '/customer/create', '/customer/edit/[$id]', '/customer/update/[$id]',
        '/customer/delete/[$id]'
    ];
});

/**
 * Faz a execução da chamada de controller
 */
$route->run();


