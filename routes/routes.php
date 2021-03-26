<?php

$route->get('/login', [\Kabum\App\Controller\Auth\LoginController::class, 'loginForm']);
$route->post('/login', [\Kabum\App\Controller\Auth\LoginController::class, 'login']);

$route->middleware([\Kabum\App\Middleware\AuthMiddleware::class], function() use ($route){
    $route->get('/dashboard', [\Kabum\App\Controller\Dashboard\DashboardController::class, 'index']);
    $route->get('/customer', [\Kabum\App\Controller\Customer\CustomerController::class, 'index']);
    $route->post('/logout', [\Kabum\App\Controller\Auth\LogoutController::class, 'logout']);
    return ['/dashboard', '/customer', '/logout'];
});

