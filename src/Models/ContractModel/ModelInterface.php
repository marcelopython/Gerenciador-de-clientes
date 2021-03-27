<?php


namespace Kabum\App\Models\ContractModel;


interface ModelInterface
{
    public function join(string $foreignKey, string $primaryKey, int $idRelationshp);

    public function create(array $data);

}