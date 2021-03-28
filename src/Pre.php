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

    public static function pre($data, $exit = true, $json = true)
    {
        echo '<pre>';
        if($json) {
            print_r(json_encode($data, true));
        }else{
            print_r($data);
        }
        echo '<pre>';
        if($exit){
            exit;
        }
    }

}