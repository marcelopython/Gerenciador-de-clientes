<?php

namespace App\Models;


use App\Models\ContractModel\CustomerInterface;

class Customer extends Model implements CustomerInterface
{
    /**Tabela do banco de dados*/
    protected string $table = 'peoples';

    /**Campos que sera preenchidos pelo formulário*/
    protected array $fields = ['name', 'cpf', 'rg', 'birth_date', 'phone'];

    /**Relacionanemtno com endereço*/
    public function address()
    {
        return $this->hasMany(Address::class, 'people_id', 'id');
    }


}