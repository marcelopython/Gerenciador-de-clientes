<?php

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