<?php

namespace App\ValidateFormRequest;

use App\ValidateFormRequest\ContractFormRequest\FormRequestInterface;

class ValidateCustomer implements FormRequestInterface
{

    private array $fields = ['name', 'cpf', 'rg', 'birth_date', 'phone'];

    private array $sizeFields = ['name'=>60, 'cpf'=>11, 'rg'=>7, 'birth_date', 'phone'=>11];

    private array $translateFiled = ['name'=>'Nome', 'cpf'=>'CPF', 'rg'=>"RG", 'birth_date'=>'Data de nascimento', 'phone'=>'Telefone'];

    public function validate(array &$request)
    {
        $this->sanitize($request);
        foreach($request as $key=> $data){
            if(empty($data)){
                throw new \InvalidArgumentException('Por favor preencha os dados obrigatório do cliente', 400);
            }
            if($key === 'cpf'){
                try {
                    $this->validateCPF($data);
                }catch (\InvalidArgumentException $e){
                    throw new \InvalidArgumentException($e->getMessage(), 400);
                }
            }
            if(!empty($this->sizeFields[$key])){
                if(strlen($data) > $this->sizeFields[$key]){
                    throw new \InvalidArgumentException('Campo '.$this->translateFiled[$key].
                        ' excedeu a quantidade de caracteres ('.$this->sizeFields[$key].')!', 400);
                }
            }
            if(array_search($key, $this->fields) === false){
                throw new \InvalidArgumentException('Dados inválidos!', 400);
            }
        }
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

    private function validateCPF(int $cpf)
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        if (strlen($cpf) != 11) {
            throw  new \InvalidArgumentException('CPF inválido', 400);
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            throw  new \InvalidArgumentException('CPF inválido', 400);
        }
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                throw  new \InvalidArgumentException('CPF inválido', 400);
            }
        }
        return true;
    }

}