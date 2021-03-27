<?php
/**
 * Created by PhpStorm.
 * User: msr
 * Date: 26/03/21
 * Time: 00:34
 */

namespace Kabum\App;


class Pre
{

    public static function pre($data, $exit = true)
    {
        echo '<pre>';
        print_r(json_encode($data, true));
        echo '<pre>';
        if($exit){
            exit;
        }
    }

}