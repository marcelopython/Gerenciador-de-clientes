<?php

namespace App\Controller\Auth;

use App\App\Pre;
use App\App\Response;
use App\Models\User;
use App\App\Router;
use App\App\Session;

trait Authenticate
{

    private $redirectNotAuthenticate = 'login';

    /*** Faz a verficação do rash retornado do cando de dados*/
    public function checkPassword($password, $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Verifica se o usuário existe no banco de dados caso sim seta o usuário na sessão
     */
    public function check(array $data): bool
    {
        $data = $this->sanitize($data);

        $user = (new User())->where('email', $data['email'])->first();
        if(!$user || !$this->checkPassword($data['password'], $user['password'])){
            return false;
        }

        Session::session('user', ['name'=>$user['name'], 'email'=>$user['email']]);
        return true;
    }

    public function sanitize(array $data)
    {
        return array_merge($data, filter_var_array($data, [
            'email'=>FILTER_SANITIZE_EMAIL,
            'password'=>FILTER_SANITIZE_STRING
        ]));
    }

    public function logout()
    {
        return new Response(200, Session::remove('user'));
    }
}