<?php

namespace Kabum\App\Controller\Auth;


use Kabum\App\Controller\Traits\Authenticate;
use Kabum\App\Models\User;
use Kabum\App\Models\ContractModel\UserInterface;
use Kabum\App\Pre;
use Kabum\App\Router;
use Kabum\App\Session;
use Kabum\App\ViewHTML;

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
        return (new Router())->redirectTo($this->redirectNotAuthenticate);
    }

}
