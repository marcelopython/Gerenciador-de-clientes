<?php


use App\Controller\Auth\LoginController;


/**
 * Rotas publicas
 */
//$route->get('/', [], function() use ($route){$route->redirectTo('login');});
//$route->get('', [], function() use ($route){$route->redirectTo('login');});
// $route->get('/login', [LoginController::class, 'loginForm']);
// $route->post('/login', [LoginController::class, 'login']);


//Rota Auth
$router->post('/login', [fn($request)=>(new LoginController)->login($request)]);
$router->post('/logout', [fn()=> (new LoginController)->logout()]);


/***
 * Middleware de verificação da autenticação do usuario
 */
//$route->middleware([App\Middleware\AuthMiddleware::class], function() use ($route){

    // $route->get('/dashboard', [App\Controller\Dashboard\DashboardController::class, 'index']);
    // $route->post('/logout', [pp\ControllerA\Auth\LogoutController::class, 'logout']);

    // /*Rotas de clientes*/
    // $route->get('/customer', [CustomerController::class, 'index']);
    // $route->get('/customer/create', [CustomerController::class, 'form']);
    // $route->post('/customer/create', [CustomerController::class, 'create']);
    // $route->get('/customer/edit/[$id]', [CustomerController::class, 'edit'])->type(['int']);
    // $route->post('/customer/update/[$id]', [CustomerController::class, 'update'])->type(['int']);
    // $route->post('/customer/delete/[$id]', [CustomerController::class, 'delete'])->type(['int']);

//});



