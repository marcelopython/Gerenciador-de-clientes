<?php
/**
 * Created by PhpStorm.
 * User: msr
 * Date: 24/03/21
 * Time: 20:53
 */

namespace Kabum\App\Models;

use Kabum\App\Models\ContractModel\UserInterface;


class User extends Model implements UserInterface
{

    protected string $table = 'users';


}