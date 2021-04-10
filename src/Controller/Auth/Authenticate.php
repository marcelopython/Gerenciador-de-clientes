<?php

namespace App\Controller\Auth;


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
        $this->startSection(['email'=>$user['email'], 'name'=>$user['name']]);
        return true;
    }

    public function startSection(array $user)
    {
        $user = $this->sanitize($user);
        Session::session('user', ['name'=>$user['name'], 'email'=>$user['email']]);
    }

    public function sanitize(array $data)
    {
        return array_merge($data, filter_var_array($data, [
            'email'=>FILTER_SANITIZE_EMAIL,
            'password'=>FILTER_SANITIZE_STRING
        ]));
    }

    /**Finaliza a sessão do usuario*/
    public function finishSession()
    {
        Session::remove('user');
    }

    public function logout()
    {
        $this->finishSession();
        (new Router())->redirectTo($this->redirectNotAuthenticate);
    }
}