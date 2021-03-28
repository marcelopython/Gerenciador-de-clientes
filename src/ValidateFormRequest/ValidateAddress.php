<?php

namespace Kabum\App\ValidateFormRequest;

use Kabum\App\ValidateFormRequest\ContractFormRequest\FormRequestInterface;

class ValidateAddress implements FormRequestInterface
{
    private array $notMandatory = ['complement'=>'', 'id'=>''];

    private array $fields = ['people_id','cep','address','number','complement','neighborhood','city','state', 'id'];

    public function validate(array &$request)
    {
        foreach($request as &$address) {
            $this->sanitize($address);
            foreach ($address as $key => $data) {
                if (empty($data) && !isset($this->notMandatory[$key])) {
                    throw new \Exception('Por favor preencha os dados obrigatório do endereço', 400);
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