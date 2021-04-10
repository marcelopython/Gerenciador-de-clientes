<?php

namespace App\Controller\Auth;


use App\Models\User;
use App\Models\ContractModel\UserInterface;
use App\App\Router;
use App\App\Session;
use App\App\ViewHTML;

class LoginController
{

    use Authenticate;

    private UserInterface $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function loginForm()
    {
        $user = Session::get('user');
        if($user){
            return (new Router())->redirectTo('dashboard');
        }
        return ViewHTML::view('auth/login');
    }

    public function login($request)
    {
        $data = $request['data_request'];
        if($this->check($data)){
            return (new Router())->redirectTo('dashboard');
        }
        Session::session('warning', 'E-mail ou senha inválido');
        return (new Router())->redirectTo($this->redirectNotAuthenticate);
    }

}
