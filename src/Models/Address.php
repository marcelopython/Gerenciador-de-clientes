<?php

namespace App\Models;


class Address extends Model
{
    /**Tabela do banco de dados*/
    protected string $table = 'address';

    /**Campos que sera preenchidos pelo formulário*/
    protected array $fields = ['people_id','cep','address','number','complement','neighborhood','city','state'];
}