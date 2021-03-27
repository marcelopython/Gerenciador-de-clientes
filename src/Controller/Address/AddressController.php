<?php

namespace Kabum\App\Controller\Address;

use Kabum\App\ViewHTML;

class AddressController
{

    public function formAdd($request, int $index)
    {
        return ViewHTML::view('customer/index', ['index'=>$index]);
    }

}