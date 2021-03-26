<?php

namespace Kabum\App\Models;
use \DB\Database\Connection;
use \DB\Database\ContractDatabase\ConnectionInterface;

class Model
{

    protected string $table = '';

    protected array $fields = [];

    private \PDO $stmt;

    private  $connection;

    public function __construct()
    {
        $this->connection = Connection::connect();
    }

    public function where($field, $value, $condition = '=')
    {
        $this->stmt = $this->connection->prepare(
            'SELECT * FROM '.$this->table.' WHERE '.$field.' '.$condition." '".$value."' "
        );
        $this->stmt->execute();
        return $this;
    }

    public function first()
    {
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function get()
    {
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $paramns = str_pad('', count($this->fields)*2, '? ',STR_PAD_LEFT);
        $sql = 'INSERT INTO '.$this->table.'('.join(', ', $this->fields).') VALUES ('.$paramns.')';
        $stmt = $this->connection->prepare($sql);
        $r = 0;
        foreach($data as $key => $item){
            if(array_search($key, $this->fields) !== false) {
                $stmt->bindValue('?', $item);
                $r ++;
            }
        }
//        echo $paramns;
//        echo "<br>";
//        var_dump($stmt->queryString);
        var_dump($stmt->execute());
        exit;
    }

}












