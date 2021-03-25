<?php
/**
 * Created by PhpStorm.
 * User: msr
 * Date: 25/03/21
 * Time: 12:16
 */

namespace Kabum\App\Controller\Traits;


use Kabum\App\Models\User;

trait Altenticate
{

    private $redirectNotAuthenticate = 'login';

    public function checkPassword($password, $hash): bool
    {
        return password_verify($password, $hash);
    }

    public function check(array $request): bool
    {
        $data = $request['data_request'];
        $data = array_merge($data, $this->sanitize($data));
        $user = (new User())->where('email', $data['email']);
        if(!$user || !$this->checkPassword($data['password'], $user['password'])){
            return false;
        }
        return true;
    }

    public function sanitize(array $data)
    {
        return filter_var_array($data, [
            'email'=>FILTER_SANITIZE_EMAIL,
            'password'=>FILTER_SANITIZE_STRING
        ]);
    }
}