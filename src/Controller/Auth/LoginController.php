<?php

namespace Kabum\App\Controller\Auth;


use Kabum\App\Models\User;
use Kabum\App\Models\ContractModel\UserInterface;
use Kabum\App\Router;
use Kabum\App\ViewHTML;

class LoginController
{

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
        $data = $request['data_request'];
        $data = array_merge($data, $this->sanitize($data));
        $user = $this->user->where('email', $data['email']);
        if(!$user){
            return $this->loginForm();
        }
        (new Router())->redirectTo('dashboard');
    }

    public function sanitize(array $data)
    {
        return filter_var_array($data, [
            'email'=>FILTER_SANITIZE_EMAIL,
            'password'=>FILTER_SANITIZE_STRING
        ]);
    }

}