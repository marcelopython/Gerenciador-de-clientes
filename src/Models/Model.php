<?php

namespace Kabum\App\Models;
use Kabum\App\Models\ContractModel\hasManyInterface;
use Kabum\App\Models\ContractModel\ModelInterface;
use Kabum\App\Pre;

class Model extends DB implements ModelInterface, hasManyInterface
{
    use Relationship;

    protected string $table = '';

    protected array $fields = [];

    private array $dataForm;

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
            throw new \PDOException($e->getMessage(), $e->getCode());

        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function createMany(array $data): Model
    {
        $this->addIdRelationship($data);
        $this->sortRecursive($data);
        $this->paramsSymbolValues($data);
        $this->prepareInsert();
        $this->executeWithMultipleInsert($data);
        $this->lastInsertId = $this->connection->lastInsertId();
        return $this;
    }

    public function join(string $foreignKey, string $primaryKey, int $idRelationshp)
    {
        $this->foreignKey = $foreignKey;
        $this->primaryKey = $primaryKey;
        $this->idRelationshp = $idRelationshp;
        return $this;
    }


}












