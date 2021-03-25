<?php
/**
 * Created by PhpStorm.
 * User: msr
 * Date: 24/03/21
 * Time: 22:03
 */

namespace Kabum\App;


class ViewHTML
{

    private function __construct(){}

    public static function view(string $path)
    {
        return include __DIR__ . '/../views/'.$path.'.php';
    }

}