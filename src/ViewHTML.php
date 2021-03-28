<?php

namespace Kabum\App;


class ViewHTML
{

    private function __construct(){}

    public static function view(string $path, array $variables = [])
    {
        if(!empty($variables)){
            extract($variables, EXTR_SKIP);
        }
        return include __DIR__ . '/../views/'.$path.'.php';
    }

}