<?php


namespace Kabum\App\Models\ContractModel;


use Kabum\App\Models\Model;

interface hasManyInterface
{
    public function createMany(array $data): Model;
    public function getDataRelation();
    public function deleteMany();
    public function updateMany(array $data);
}