<?php

namespace Kabum\App\Controller\Auth;


use Kabum\App\Controller\Traits\Altenticate;
use Kabum\App\Models\User;
use Kabum\App\Models\ContractModel\UserInterface;
use Kabum\App\Router;
use Kabum\App\ViewHTML;

class LoginController
{

    use Altenticate;

    private UserInterface $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function loginForm()
    {
        return ViewHTML::view('auth/login');
    }

    public function login($request)
    {
        if($this->check($request)){
            return (new Router())->redirectTo('dashboard');
        }
        (new Router())->redirectTo($this->redirectNotAuthenticate);
    }


}