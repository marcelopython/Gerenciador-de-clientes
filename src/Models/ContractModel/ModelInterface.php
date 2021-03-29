<?php


namespace Kabum\App\Models\ContractModel;


use Kabum\App\Models\Model;

interface ModelInterface
{
    public function setRelation(string $foreignKey, string $primaryKey, int $idRelationshp);

    public function create(array $data): ModelInterface;

    public function where($field, $value, $condition = '=');

    public function first();

    public function get(): array;

    public function find(int $id): Model;

    public function all(): array;

    public function update(array $data, $value = 0): Model;

    public function delete(int $id): Model;

    public function deleteIn(array $values = []): void;


}