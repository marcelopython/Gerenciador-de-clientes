<?php
namespace Kabum\App\Controller\Customer;


use Kabum\App\Models\ContractModel\CustomerInterface;
use Kabum\App\Models\Customer;
use Kabum\App\Pre;
use Kabum\App\Router;
use Kabum\App\ValidateFormRequest\ContractFormRequest\FormRequestInterface;
use Kabum\App\ValidateFormRequest\ValidateAddress;
use Kabum\App\ValidateFormRequest\ValidateCustomer;
use Kabum\App\ViewHTML;

class CustomerController
{

    private CustomerInterface $customer;

    private FormRequestInterface $ValidateCustomer;

    private FormRequestInterface $ValidateAddress;

    public function __construct()
    {
        $this->customer = new Customer();
        $this->ValidateCustomer = new  ValidateCustomer();
        $this->ValidateAddress = new  ValidateAddress();
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
        $this->ValidateCustomer->validate($data);
        $this->ValidateAddress->validate($address);
        $peopleDB = $this->customer->beginTransaction();
        $pessoa = $peopleDB->create($data)->address()->createMany($address);
        if($pessoa->getId()){
            $peopleDB->commit();
            (new Router())->redirectTo('customer');
        }else{
            $peopleDB->rollback();
        }
    }
}






















