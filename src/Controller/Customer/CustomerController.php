<?php
/**
 * Created by PhpStorm.
 * User: msr
 * Date: 25/03/21
 * Time: 00:34
 */

namespace Kabum\App\Controller\Customer;


use Kabum\App\Models\People;
use Kabum\App\Pre;
use Kabum\App\ViewHTML;

class CustomerController
{

    public function index()
    {
        return ViewHTML::view('customer/index');
    }

    public function form()
    {
        return ViewHTML::view('customer/create');
    }

    public function create(array $request)
    {

        $data = $request['data_request'];
        echo (new People())->create($data);

        exit;
        Pre::pre($request);
    }
}