<?php


namespace App\Models;

use App\Models\ContractModel\UserInterface;


class User extends Model implements UserInterface
{
    /**Tabela do banco de dados*/
    protected string $table = 'users';


}