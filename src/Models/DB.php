<?php

namespace Kabum\App\Models;

use DB\Database\Connection;
use Kabum\App\Models\ContractModel\DBAbstract;
use Kabum\App\Pre;

class DB extends DBAbstract
{
    protected \PDOStatement $stmt;

    protected int $lastInsertId;

    protected string $paramnsSymbol;

    protected \PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::connect();
    }

    public function getId(): int
    {
        return $this->lastInsertId;
    }
    protected final function prepareInsert(): DBAbstract
    {
        $this->stmt = $this->connection->prepare(
            'INSERT INTO '.$this->table.'('.join(', ', $this->fields).') VALUES '.$this->paramnsSymbol.';'
        );
        return $this;
    }

    protected final function executeWithMultipleInsert(array $data): DBAbstract
    {
        $valueInsert = [];
        foreach ($data as $value){
            $valueInsert = array_merge($valueInsert, array_values($value));
        }
        $this->stmt->execute($valueInsert);
        if($this->stmt->errorCode() !== '00000'){
            throw new \PDOException($this->stmt->errorInfo()[2], $this->stmt->errorCode()[0]);
        }
        return $this;
    }

    protected final function executeWithParam(array $data): DBAbstract
    {
        $valuesData = array_values($data);
        $this->stmt->execute($valuesData);
        if($this->stmt->errorCode() !== '00000'){
            throw new \PDOException($this->stmt->errorInfo()[2], $this->stmt->errorCode()[0]);
        }
        $this->lastInsertId = $this->connection->lastInsertId();
        return $this;
    }

    protected final function sort(array &$data): DBAbstract
    {
        asort($this->fields);
        ksort($data);
        return $this;
    }

    protected final function sortRecursive(array &$data): DBAbstract
    {
        asort($this->fields);
        foreach($data as $key => &$value){
            ksort($value);
        }
        return $this;
    }

    protected final function paramnsSymbol(): DBAbstract
    {
        $this->paramnsSymbol = '('.join(', ',
            explode(' ',
                str_pad('', (count($this->fields) * 2) - 1, '? ', STR_PAD_LEFT)
            )
        ).')';
        return $this;
    }

    protected final function paramsSymbolValues(array $data): DBAbstract
    {
        $this->paramnsSymbol();
        $this->paramnsSymbol = str_pad($this->paramnsSymbol,
                (strlen($this->paramnsSymbol)*count($data))+count($data)-1,
                ','.$this->paramnsSymbol
            );
        return $this;
    }
    public function beginTransaction()
    {
        $this->connection->beginTransaction();
        return $this;

    }

    public function commit()
    {
        $this->connection->commit();
        return $this;

    }

    public function rollback()
    {
        $this->connection->rollBack();
        return $this;
    }
}