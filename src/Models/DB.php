<?php

namespace Kabum\App\Models;

use DB\Database\Connection;
use Kabum\App\Models\ContractModel\DBAbstract;
use Kabum\App\Pre;

class DB extends DBAbstract
{

    protected string $table = '';

    protected array $fields = [];

    protected \PDOStatement $stmt;

    protected int $lastInsertId;

    protected string $key = 'id';

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

    protected final function prepareDelete(): DBAbstract
    {
        $this->stmt = $this->connection->prepare('DELETE FROM '.$this->table.' WHERE '.$this->key.'?');
        return $this;
    }

    protected final function prepareDeleteMultiple(): DBAbstract
    {
        $this->stmt = $this->connection->prepare(
            'DELETE FROM '.$this->table.' WHERE '.$this->key.' IN '.$this->paramnsSymbol
        );
        return $this;
    }

    protected final function prepareInsert(): DBAbstract
    {
        $this->stmt = $this->connection->prepare(
            'INSERT INTO '.$this->table.'('.join(', ', $this->fields).') VALUES '.$this->paramnsSymbol.';'
        );
        return $this;
    }

    protected final function prepareUpdate(string $condition = '='): DBAbstract
    {
        $this->stmt = $this->connection->prepare(
            'UPDATE '.$this->table.' SET '.join('=?, ', $this->fields).'=? WHERE '.$this->key.' '.$condition.' ?;'
        );
        return $this;
    }

    protected final function select($partSql = '')
    {
        $this->stmt = $this->connection->prepare('SELECT * FROM '.$this->table.$partSql);
        $this->stmt->execute();
        try {
            $this->validationPdo();
        }catch (\PDOException $e){
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
    }

    protected final function executeWithMultipleParam(array $data): DBAbstract
    {
        $valueInsert = [];
        foreach ($data as $value){
            $valueInsert = array_merge($valueInsert, array_values($value));
        }
        $this->stmt->execute($valueInsert);
        try {
            $this->validationPdo();
        }catch (\PDOException $e){
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
        return $this;
    }
    private final function validationPdo()
    {
        if($this->stmt->errorCode() !== '00000'){
            $code = null;
            if(!is_numeric($this->stmt->errorCode())){
                $code = 0;
            }else{
                $code = $this->stmt->errorCode();
            }
            throw new \PDOException($this->stmt->errorInfo()[2], $code);
        }
    }

    protected final function executeWithMultipleDelete(array $data): DBAbstract
    {
        $this->stmt->execute(array_values($data));
        try {
            $this->validationPdo();
        }catch (\PDOException $e){
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
        return $this;
    }

    protected final function executeWithParam(array $data): DBAbstract
    {
        $valuesData = array_values($data);
        $this->stmt->execute($valuesData);
        try {
            $this->validationPdo();
        }catch (\PDOException $e){
            throw new \PDOException($e->getMessage(), $e->getCode());
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

    protected final function paramnsSymbol(array $fields = []): DBAbstract
    {
        $filedToCount = [];
        if(!empty($fields)){
            $filedToCount = $fields;
        }else{
            $filedToCount = $this->fields;
        }
        $this->paramnsSymbol = '('.join(', ',
                explode(' ',
                    str_pad('', (count($filedToCount) * 2) - 1, '? ', STR_PAD_LEFT)
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