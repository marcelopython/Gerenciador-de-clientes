<?php

namespace Kabum\App\Models;
use \DB\Database\Connection;
use \DB\Database\ContractDatabase\ConnectionInterface;

class Model
{

    protected string $table = '';

    private  $connection;

    public function __construct()
    {
        $this->connection = Connection::connect();
    }

    public function where($field, $value, $condition = '=')
    {
        $stmt = $this->connection->prepare(
            'SELECT * FROM '.$this->table.' WHERE '.$field.' '.$condition." '".$value."' "
        );
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

}