<?php
namespace Kabum\App\Controller\Customer;


use Kabum\App\Models\Customer;
use Kabum\App\Pre;
use Kabum\App\ViewHTML;

class CustomerController
{

    private $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }

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
        $address = array_pop($data);
        $people = $this->customer->create($data);
        $people->address()->createMany($address);
    }
}






















