<?php

namespace App\Models;
use App\Models\ContractModel\hasManyInterface;
use App\Models\ContractModel\ModelInterface;
use App\App\Router;

class Model extends DB implements ModelInterface, hasManyInterface
{
    use Relationship;

    public array $data;

    public function where($field, $value, $condition = '='): ModelInterface
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

    public function count(): int
    {
        return $this->stmt->rowCount();
    }

    public function find(int $id): Model
    {
        $this->where($this->key, $id, '=');
        $data = $this->first();
        if(!$data){
            return (new Router())->redirectTo('http/404');
        }
        $this->data = $data;
        $this->lastInsertId = $id;
        return $this;
    }

    public function all(): array
    {
        $this->select();
        return $this->get();
    }

    public function create(array $data): ModelInterface
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
        $this->sortWithMultipleItems($data);
        $this->multiplesParamsSymbol($data);
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

    public function deleteMany(): void
    {
        $this->columns = [$this->key];
        $values = $this->getDataRelation();
        $ids = array_map(function ($item) {
            if ($item[$this->key]) {
                return $item[$this->key];
            }
        }, $values);
        $this->deleteIn($ids);
    }

    public function paginate(int $offset = 0, int $limit = 10): array
    {
        if($offset <= 1){
            $offset = 0;
        }else{
            $offset =  ($limit*$offset)-$limit;
        }
        $this->select(' ORDER BY '.$this->key.' DESC  LIMIT '.$limit.' OFFSET '.$offset);
        $items = $this->get();
        $this->select();
        $totalItem = $this->count();
        $selfPath = $_SERVER['PHP_SELF'];
        $link = [];
        for($i = 1; $i <= ceil($totalItem/$limit); $i ++){
            $link[] = $selfPath.'?page='.$i;
        }
        return [
            'items'=>$items,
            'links'=>$link
        ];
    }

    public function deleteIn(array $values = []): void
    {
        $this->paramnsSymbol($values);
        $this->prepareDeleteMultiple();
        $this->executeWithMultipleDelete($values);
    }

    public function delete(int $id): Model
    {
        $this->prepareDelete();
        $this->executeWithParam([$id]);
        $this->lastInsertId = $id;
        return $this;
    }

    public function getDataRelation(): array
    {
        return $this->where($this->foreignKey, $this->idRelationshp, '=')->get();
    }

    public function setRelation(string $foreignKey, string $primaryKey, int $idRelationshp)
    {
        $this->foreignKey = $foreignKey;
        $this->primaryKey = $primaryKey;
        $this->idRelationshp = $idRelationshp;
        return $this;
    }
}












