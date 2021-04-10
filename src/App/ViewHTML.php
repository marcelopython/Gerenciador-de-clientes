<?php

namespace App\App;

/**
 * classe para retornar o html
 */
class ViewHTML
{

    private function __construct(){}

    public static function view(string $path, array $variables = [])
    {
        if(!empty($variables)){
            /*** Extrai variaveis apartir de array*/
            extract($variables, EXTR_SKIP);
        }
//        Pre::pre(__DIR__ . '/../../views/' .$path.'.php');
        return include __DIR__ . '/../../views/' .$path.'.php';
    }

}