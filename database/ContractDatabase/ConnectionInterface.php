<?php

namespace DB\Database\ContractDatabase;


interface ConnectionInterface
{

    public static function connect(): \PDO;

}