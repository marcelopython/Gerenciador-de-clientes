<?php

namespace App\Models;

use App\Models\ContractModel\hasManyInterface;

trait Relationship
{
    private string  $foreignKey;

    private  string $primaryKey;

    private int $idRelationshp;

    public function hasMany(string $class, string $foreignKey, string $primaryKey): hasManyInterface
    {
         return (new $class())->setRelation($foreignKey, $primaryKey, $this->lastInsertId);
    }

    private final function addIdRelationship(array &$data): void
    {
        $data = array_map(function($param){
            $param[$this->foreignKey] = $this->idRelationshp;
            return $param;
        }, $data);
    }

}