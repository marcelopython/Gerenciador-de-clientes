<?php

namespace Kabum\App\Models\ContractModel;


abstract class DBAbstract
{
    protected abstract function prepareInsert(): DBAbstract;

    protected abstract function executeWithMultipleParam(array $data): DBAbstract;

    protected abstract function executeWithParam(array $data): DBAbstract;

    protected abstract function sort(array &$data): DBAbstract;

    protected abstract function sortRecursive(array &$data): DBAbstract;

    protected abstract function paramnsSymbol(array $fields): DBAbstract;

    protected abstract function paramsSymbolValues(array $data): DBAbstract;

    protected abstract function prepareUpdate(string $condition = '='): DBAbstract;

}