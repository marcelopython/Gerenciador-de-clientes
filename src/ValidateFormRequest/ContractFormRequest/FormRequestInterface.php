<?php


namespace Kabum\App\ValidateFormRequest\ContractFormRequest;


interface FormRequestInterface
{
    public function validate(array &$request);
}