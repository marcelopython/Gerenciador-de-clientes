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
        $customers = $this->customer->all();
        return ViewHTML::view('customer/index', ['customers'=>$customers]);
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

    public function edit(array $request, int $id)
    {
        $customer = $this->customer->find($id);
        $dataCustomer = $customer->data;
        $addresses = $customer->address()->getDataRelation();
        return ViewHTML::view('customer/edit', ['customer'=>$dataCustomer, 'addresses'=>$addresses]);
    }

    public function update(array $request, int $id)
    {
        $peopleDB = $this->customer->beginTransaction();
        try {
            $customer = $request['data_request'];
            $address = array_pop($customer);
            $this->ValidateCustomer->validate($customer);
            $this->ValidateAddress->validate($address);
            $peopleDB->update($customer, $id);
            $newAddress = $this->getNewAddressInformEdit($address);
            $addressesData = $peopleDB->address();
            $addressDeleted = $this->getAddressDeletedItTheFormEdit($addressesData->getDataRelation(), $address);
            if(!empty($newAddress)) {
                $addressesData->createMany($newAddress);
            }
            if(!empty($addressDeleted)) {
                $addressesData->deleteMany($addressDeleted);
            }
            $oldAddress = $this->getOldAddressInformEdit($address);
            $addressesData->updateMany($oldAddress);
            $peopleDB->commit();
            (new Router())->redirectTo('customer');
        }catch(\PDOException $e){
            Pre::pre($e->getMessage());
            $peopleDB->rollback();

        }catch(\Exception $e){
            Pre::pre($e->getMessage());
            $peopleDB->rollback();
        }
    }

    public function getNewAddressInformEdit(array $address): array
    {
        return array_filter(
            array_map(function($address){
                if(empty($address['id'])){
                    return $address;
                }
            }, $address)
        );
    }

    public function getOldAddressInformEdit(array $address): array
    {
        return array_filter(
            array_map(function($address){
                if(!empty($address['id'])){
                    return $address;
                }
            }, $address)
        );
    }

    public function getAddressDeletedItTheFormEdit($addressesData, $address): array
    {
        $idsOldAddress = array_map(function($addressBd){
            if($addressBd['id']){
                return $addressBd['id'];
            }
        }, $addressesData);

        $idsNewAddress = array_filter(
            array_map(function($address){
                if(!empty($address['id'])){
                    return $address['id'];
                }
            }, $address)
        );
         return array_diff($idsOldAddress, $idsNewAddress);
    }

}






















