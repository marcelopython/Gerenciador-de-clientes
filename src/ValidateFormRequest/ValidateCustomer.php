<?php

namespace Kabum\App\ValidateFormRequest;

use Kabum\App\Pre;
use Kabum\App\ValidateFormRequest\ContractFormRequest\FormRequestInterface;

class ValidateCustomer implements FormRequestInterface
{

    private array $fields = [
        'name', 'cpf', 'rg', 'birth_date', 'phone'
    ];

    public function validate(array $request)
    {
        $this->sanitize($request);
        foreach($request as $key=> $data){
            if(empty($data)){
                throw new \Exception('Por favor preencha os dados obrigatório do cliente', 400);
            }
            if(array_search($key, $this->fields) === false){
                throw new \InvalidArgumentException('Dados inválidos!', 400);
            }
        }
        return $request;
    }

    private function sanitize(array &$request)
    {
        $request = array_merge(
            $request,
            filter_var_array($request, [
                'name'=>FILTER_SANITIZE_STRING,
                'cpf'=>FILTER_SANITIZE_NUMBER_INT,
                'rg'=>FILTER_SANITIZE_NUMBER_INT,
                'phone'=>FILTER_SANITIZE_NUMBER_INT
            ])
        );
    }

}