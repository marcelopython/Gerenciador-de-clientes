<?php
/**
 * Created by PhpStorm.
 * User: msr
 * Date: 25/03/21
 * Time: 00:34
 */

namespace Kabum\App\Controller\Customer;


use Kabum\App\ViewHTML;

class CustomerController
{

    public function index()
    {
        return ViewHTML::view('customer/index');
    }

}