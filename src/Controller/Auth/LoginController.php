<?php

namespace App\Controller\Auth;

use App\App\Request;
use App\App\Response;
use App\App\Session;
use App\Models\User;
use App\Models\ContractModel\UserInterface;

class LoginController
{

    use Authenticate;

    private UserInterface $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public  function login(Request $request)
    {
        $data = $request->getPostVars();
        if($this->check($data)){
            return new Response(200, Session::get('user'));
        }
        return new Response(403, 'Login ou senha inválidos');
    }

}
