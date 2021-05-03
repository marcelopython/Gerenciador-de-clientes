<?php

use App\App\Response;
use App\Controller\Auth\LoginController;


//Rota Auth
$router->post('/login', [fn($request)=>(new LoginController)->login($request)]);
$router->post('/logout', [fn()=> (new LoginController)->logout()]);

$router->get('/', [fn()=> new Response(200, (new App\App\View)->render('index'), 'text/html')]);




