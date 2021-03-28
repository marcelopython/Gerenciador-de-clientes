<?php
namespace Kabum\App\Controller\Customer;

use Kabum\App\Business\AddressBo;
use Kabum\App\Models\ContractModel\CustomerInterface;
use Kabum\App\Models\Customer;
use Kabum\App\Pre;
use Kabum\App\Router;
use Kabum\App\Session;
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

    public function index($request)
    {
//        Pre::pre($request);
//        $customers = $this->customer->all();
        if(!empty($request['data_request']['page'])){
            $customers = $this->customer->paginate($request['data_request']['page']);
        }else{
            $customers = $this->customer->paginate();
        }
        return ViewHTML::view('customer/index', ['customers'=>$customers]);
    }

    public function form()
    {
        return ViewHTML::view('customer/create');
    }

    public function create(array $request)
    {
        $peopleDB = $this->customer->beginTransaction();
        try{
            $data = $request['data_request'];
            $address = array_pop($data);
            $this->ValidateCustomer->validate($data);
            $this->ValidateAddress->validate($address);
            $pessoa = $peopleDB->create($data)->address()->createMany($address);
            if($pessoa->getId()){
                $peopleDB->commit();
                Session::session('success', 'Cliente cadastrado com sucesso!');
                (new Router())->redirectTo('customer');
            }else{
                $peopleDB->rollback();
            }
        }catch(\PDOException $e){
            Session::session('error', 'Falha ao gravar registros');
            $peopleDB->rollback();
            (new Router())->redirectTo('customer/create');
        }catch(\Exception $e){
            if($e->getCode() === 400) {
                Session::session('warning', $e->getMessage());
            }else{
                Session::session('error', 'Ocorreu um erro inesperado');
            }
            (new Router())->redirectTo('customer/create');
            $peopleDB->rollback();
        }catch(\InvalidArgumentException $e){
            if($e->getCode() === 400) {
                Session::session('warning', $e->getMessage());
            }
            $peopleDB->rollback();
            (new Router())->redirectTo('customer/create');
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
        $customerBd = $this->customer->beginTransaction();
        try {
            $customer = $request['data_request'];
            $address = array_pop($customer);
            $this->ValidateCustomer->validate($customer);
            $customerBd->update($customer, $id);
            (new AddressBo())->update($customerBd, $address);
            $customerBd->commit();
            Session::session('success', 'Cliente atualizado com sucesso!');
            (new Router())->redirectTo('customer');

        }catch(\PDOException $e){
            Session::session('error', 'Falha ao atualizar registros');
            $customerBd->rollback();
            (new Router())->redirectTo('customer/edit/'.$id);

        }catch(\Exception $e){
            if($e->getCode() === 400) {
                Session::session('warning', $e->getMessage());
            }else{
                Session::session('error', 'Ocorreu um erro inesperado');
            }
            $customerBd->rollback();
            (new Router())->redirectTo('customer/edit/'.$id);

        }catch(\InvalidArgumentException $e){
            if($e->getCode() === 400) {
                Session::session('warning', $e->getMessage());
            }
            $customerBd->rollback();
            (new Router())->redirectTo('customer/edit/'.$id);
        }
    }

    public function delete(array $request, int $id)
    {
        $customer = $this->customer->beginTransaction();
        try {
            $customer->find($id);
            $customer->address()->deleteMany();
            $customer->delete($id);
            $customer->commit();
            Session::session('success', 'Cliente deletado com sucesso!');
        }catch (\PDOException $e){
            Session::session('error', 'Falha ao remover registros');
            $customer->rollback();
        }catch (\Exception $e){
            if($e->getCode() === 400) {
                Session::session('warning', $e->getMessage());
            }else{
                Session::session('error', 'Ocorreu um erro inesperado');
            }
            $customer->rollback();
        }finally {
            (new Router())->redirectTo('customer');
        }
    }

}






















