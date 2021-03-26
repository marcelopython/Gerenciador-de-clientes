<?php
/**
 * Created by PhpStorm.
 * User: msr
 * Date: 25/03/21
 * Time: 20:17
 */

namespace Kabum\App\Middleware;


use Kabum\App\Router;
use Kabum\App\Session;

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