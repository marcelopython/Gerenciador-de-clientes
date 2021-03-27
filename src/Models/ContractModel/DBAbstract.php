<?php

namespace Kabum\App\Models\ContractModel;


abstract class DBAbstract
{
    protected abstract function prepareInsert(): DBAbstract;

    protected abstract function executeWithMultipleInsert(array $data): DBAbstract;

    protected abstract function executeWithParam(array $data): DBAbstract;

    protected abstract function sort(array &$data): DBAbstract;

    protected abstract function sortRecursive(array &$data): DBAbstract;

    protected abstract function paramnsSymbol(): DBAbstract;

    protected abstract function paramsSymbolValues(array $data): DBAbstract;

}