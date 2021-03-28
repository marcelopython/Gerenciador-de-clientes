<?php
/**
 * Created by PhpStorm.
 * User: msr
 * Date: 26/03/21
 * Time: 00:39
 */

namespace Kabum\App\Models;


use Kabum\App\Models\ContractModel\CustomerInterface;

class Customer extends Model implements CustomerInterface
{

    protected string $table = 'peoples';

    protected array $fields = ['name', 'cpf', 'rg', 'birth_date', 'phone'];

    public function address()
    {
        return $this->hasMany(Address::class, 'people_id', 'id');
    }


}