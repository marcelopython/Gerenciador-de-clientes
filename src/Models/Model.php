<?php

namespace Kabum\App\Models;
use Kabum\App\Models\ContractModel\hasManyInterface;
use Kabum\App\Models\ContractModel\ModelInterface;

class Model extends DB implements ModelInterface, hasManyInterface
{
    use Relationship;

    public array $data;

    public function where($field, $value, $condition = '=')
    {
        $this->select(' WHERE '.$field.' '.$condition." '".$value."' ");
        return $this;
    }

    public function first()
    {
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function get(): array
    {
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find(int $id): Model
    {
        $this->where($this->key, $id, '=');
        $this->data = $this->first();
        $this->lastInsertId = $id;
        return $this;
    }

    public function all(): array
    {
        $this->select();
        return $this->get();
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

    public function update(array $data, $value = 0): Model
    {
        $this->sort($data);
        $this->paramnsSymbol();
        $this->prepareUpdate();
        unset($data[$this->key]);
        $data[$this->key] = $value;
        $this->executeWithParam($data);
        $this->lastInsertId = $value;
        return $this;
    }

    public function createMany(array $data): Model
    {
        $this->addIdRelationship($data);
        $this->sortRecursive($data);
        $this->paramsSymbolValues($data);
        $this->prepareInsert();
        $this->executeWithMultipleParam($data);
        $this->lastInsertId = $this->connection->lastInsertId();
        return $this;
    }

    public function updateMany(array $data): Model
    {
        unset($this->fields[array_search($this->foreignKey, $this->fields)]);
        foreach($data as $item){
            $this->update($item, $item[$this->key]);
        }
        return $this;
    }

    public function deleteMany(array $values = []): void
    {
        $this->paramnsSymbol($values);
        $this->prepareDeleteMultiple();
        $this->executeWithMultipleDelete($values);
    }

    public function getDataRelation(): array
    {
        return $this->where($this->foreignKey, $this->idRelationshp, '=')->get();
    }

    public function join(string $foreignKey, string $primaryKey, int $idRelationshp)
    {
        $this->foreignKey = $foreignKey;
        $this->primaryKey = $primaryKey;
        $this->idRelationshp = $idRelationshp;
        return $this;
    }
}












