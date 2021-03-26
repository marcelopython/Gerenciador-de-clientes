<?php
/**
 * Created by PhpStorm.
 * User: msr
 * Date: 25/03/21
 * Time: 12:16
 */

namespace Kabum\App\Controller\Traits;


use Kabum\App\Models\User;
use Kabum\App\Router;
use Kabum\App\Session;

trait Authenticate
{

    private $redirectNotAuthenticate = 'login';

    public function checkPassword($password, $hash): bool
    {
        return password_verify($password, $hash);
    }

    public function check(array $data): bool
    {
        $data = $this->sanitize($data);
        $user = (new User())->where('email', $data['email']);
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