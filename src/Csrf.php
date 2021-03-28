<?php


namespace Kabum\App;

/**
 * Class Csrf
 * @package Kabum\App
 * Prevenção contra ataques CSRF
 * Por cada requisição e criado um novo rash para compara com o que foi enviado pelo formulario
 */
class Csrf extends Session
{

    public static function setCsrf(){
        self::session('md5', hash('sha256', date('dmYHiS', strtotime('now'))));
    }

    public static function csrf(){
        return self::get('md5');
    }

}