<?php
/**
 * Created by PhpStorm.
 * User: msr
 * Date: 26/03/21
 * Time: 00:39
 */

namespace Kabum\App\Models;


class People extends Model
{

    protected string $table = 'peoples';

    protected array $fields = ['name', 'cpf', 'rg', 'birth_date', 'phone'];

}