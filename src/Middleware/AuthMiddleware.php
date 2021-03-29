<?php

namespace Kabum\App\Middleware;


use Kabum\App\Router;
use Kabum\App\Session;

/**
 * verificação se o usuario esta logado
 * Usado em rotas que necessita de autenticação
 */
class AuthMiddleware
{

    public function middleware($request, \Closure $next)
    {
        $user = Session::get('user');
        if(!$user){
            return (new Router)->redirectTo('login');
        }
        return $next($request);
    }

}