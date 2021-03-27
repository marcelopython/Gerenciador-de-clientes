<?php

namespace Kabum\App\Models;
use \DB\Database\Connection;
use \DB\Database\ContractDatabase\ConnectionInterface;
use Kabum\App\Models\ContractModel\hasManyInterface;
use Kabum\App\Models\ContractModel\ModelInterface;
use Kabum\App\Pre;

class Model implements ModelInterface, hasManyInterface
{

    use Relationship;

    protected string $table = '';

    protected array $fields = [];

    private \PDOStatement $stmt;

    private  $connection;

    private $lastInsertId;

    private $paramnsSymbol;

    private array $dataForm;

    public function __construct()
    {
        $this->connection = Connection::connect();
    }

    public function getLastInsertId()
    {
        return $this->lastInsertId;
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
        try {
            $this->sort($data);
            $this->paramnsSymbol();
            $this->prepareInsert();
            $this->executeWithParam($data);
            return $this;
        }catch(\PDOException $e){
            throw new \Exception($e->getMessage(), $e->getCode());

        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function createMany(array $data)
    {
        $this->addIdRelationship($data);
        $this->sortRecursive($data);
        $this->paramsSymbolValues($data);
        $this->prepareInsert();
        $this->executeWithMultipleInsert($data);
        $this->lastInsertId = $this->connection->lastInsertId();
        return $this;
    }

    private final function prepareInsert()
    {
        $this->stmt = $this->connection->prepare(
            'INSERT INTO '.$this->table.'('.join(', ', $this->fields).') VALUES '.$this->paramnsSymbol.';'
        );
    }

    private final function executeWithMultipleInsert(array $data)
    {
        $valueInsert = [];
        foreach ($data as $value){
            $valueInsert = array_merge($valueInsert, array_values($value));
        }
        if(!$this->stmt->execute($valueInsert)){
            throw new \PDOException('Falha ao inserir registro');
        }
    }

    private final function executeWithParam(array $data)
    {
        $valuesData = array_values($data);
        $this->stmt->execute($valuesData);
        $this->lastInsertId = $this->connection->lastInsertId();
    }

    private final function sort(array &$data)
    {
        asort($this->fields);
        ksort($data);
    }

    private final function sortRecursive(array &$data)
    {
        asort($this->fields);
        foreach($data as $key => &$value){
            ksort($value);
        }
    }

    private final function paramnsSymbol()
    {
        $this->paramnsSymbol = '('.join(', ',
            explode(' ',
                str_pad('', (count($this->fields) * 2) - 1, '? ', STR_PAD_LEFT)
            )
        ).')';
    }

    private final function paramsSymbolValues(array $data)
    {
        $this->paramnsSymbol();
        $this->paramnsSymbol = substr(
            str_pad($this->paramnsSymbol,
                (strlen($this->paramnsSymbol)*count($data))+2, ','.$this->paramnsSymbol),
            0, -1);
    }

    public function join(string $foreignKey, string $primaryKey, int $idRelationshp)
    {
        $this->foreignKey = $foreignKey;
        $this->primaryKey = $primaryKey;
        $this->idRelationshp = $idRelationshp;
        return $this;
    }


}












