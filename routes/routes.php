<?php


use App\Controller\Auth\LoginController;


//Rota Auth
$router->post('/login', [fn($request)=>(new LoginController)->login($request)]);
$router->post('/logout', [fn()=> (new LoginController)->logout()]);




