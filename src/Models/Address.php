<?php

namespace Kabum\App\Models;


class Address extends Model
{
    protected string $table = 'address';

    protected array $fields = ['people_id','cep','address','number','complement','neighborhood','city','state'];
}