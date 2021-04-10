<?php


namespace App\ValidateFormRequest\ContractFormRequest;


interface FormRequestInterface
{
    public function validate(array &$request);
}