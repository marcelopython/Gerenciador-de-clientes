<?php
/**
 * Created by PhpStorm.
 * User: msr
 * Date: 25/03/21
 * Time: 12:45
 */

namespace Kabum\App;


abstract class Session
{
    private function __construct(){}

    public static function session(string $key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    public final static function get(string $key)
    {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return null;
    }

    public final static function remove(string $key)
    {
        unset($_SESSION[$key]);
    }

}