<?php

namespace Kabum\App\ValidateFormRequest;

use Kabum\App\ValidateFormRequest\ContractFormRequest\FormRequestInterface;

class ValidateAddress implements FormRequestInterface
{
    private array $notMandatory = ['complement'=>'', 'id'=>''];

    private array $fields = ['people_id','cep','address','number','complement','neighborhood','city','state', 'id'];

    private array $sizeFields = ['cep'=>9,'address'=>100,'number'=>10,'complement'=>60,'neighborhood'=>60,'city'=>60,'state'=>30];

    private array $translateFiled = ['cep'=>'Cep','address'=>'Endereço','number'=>'Numero','complement'=>'Complemento',
        'neighborhood'=>'Bairro','city'=>'Cidade','state'=>'Estado'];

    public function validate(array &$request)
    {
        foreach($request as &$address) {
            $this->sanitize($address);
            foreach ($address as $key => $data) {
                if (empty($data) && !isset($this->notMandatory[$key])) {
                    throw new \InvalidArgumentException('Por favor preencha '.$this->translateFiled[$key].' campo obrigatorio!', 400);
                }
                if(!empty($this->sizeFields[$key])){
                    if(strlen($data) > $this->sizeFields[$key]){
                        throw new \InvalidArgumentException('Campo '.$this->translateFiled[$key].' excedeu a quantidade de caracteres!', 400);
                    }
                }
                if (array_search($key, $this->fields) === false) {
                    throw new \InvalidArgumentException('Dados inválidos!', 400);
                }
            }
        }
    }

    private function sanitize(array &$request)
    {
        $request = array_merge(
            $request,
            filter_var_array($request, [
                'cep'=>FILTER_SANITIZE_NUMBER_INT,
                'address'=>FILTER_SANITIZE_STRING,
                'number'=>FILTER_SANITIZE_STRING,
                'complement'=>FILTER_SANITIZE_STRING,
                'neighborhood'=>FILTER_SANITIZE_STRING,
                'city'=>FILTER_SANITIZE_STRING,
                'state'=>FILTER_SANITIZE_STRING,
            ])
        );
    }

}