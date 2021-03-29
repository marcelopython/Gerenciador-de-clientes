<?php

namespace Kabum\App\Business;

use http\Exception\InvalidArgumentException;
use Kabum\App\Models\ContractModel\CustomerInterface;
use Kabum\App\Pre;
use Kabum\App\ValidateFormRequest\ContractFormRequest\FormRequestInterface;
use Kabum\App\ValidateFormRequest\ValidateAddress;

class AddressBo
{
    private FormRequestInterface $ValidateAddress;

    public static array $states = [
        'AC'=>'Acre','AL'=>'Alagoas','AP'=>'Amapá','AM'=>'Amazonas','BA'=>'Bahia','CE'=>'Ceará','ES'=>'Espírito Santo',
        'GO'=>'Goiás','MA'=>'Maranhão','MT'=>'Mato Grosso','MS'=>'Mato Grosso do Sul','MG'=>'Minas Gerais',
        'PA'=>'Pará','PB'=>'Paraíba','PR'=>'Paraná','PE'=>'Pernambuco','PI'=>'Piauí','RN'=>'Rio Grande do Norte',
        'RS'=>'Rio Grande do Sul','RO'=>'Rondônia','SC'=>'Santa Catarina','SE'=>'Sergipe','DF'=>'Distrito Federal',
    ];

    public function __construct()
    {
        $this->ValidateAddress = new  ValidateAddress();
    }

    public function update(CustomerInterface $customerBd, array $address)
    {
        try {
            $this->ValidateAddress->validate($address);
            $addressesData = $customerBd->address();
            $newAddress = $this->getNewAddressInformEdit($address);
            $addressDeleted = $this->getAddressDeletedItTheFormEdit($addressesData->getDataRelation(), $address);
            if (!empty($newAddress)) {
                $addressesData->createMany($newAddress);
            }
            if (!empty($addressDeleted)) {
                $addressesData->deleteIn($addressDeleted);
            }
            $oldAddress = $this->getOldAddressInformEdit($address);
            $addressesData->updateMany($oldAddress);
        }catch(\Exception $e){
            if($e->getCode() === 400){
                throw new \Exception($e->getMessage(), $e->getCode());
            }
            throw new \Exception('Falha ao atualizar endereço');
        }
    }

    public function getNewAddressInformEdit(array $address): array
    {
        return array_filter(
            array_map(function($address){
                if(empty($address['id'])){
                    return $address;
                }
            }, $address)
        );
    }

    public function getOldAddressInformEdit(array $address): array
    {
        return array_filter(
            array_map(function($address){
                if(!empty($address['id'])){
                    return $address;
                }
            }, $address)
        );
    }

    public function getAddressDeletedItTheFormEdit($addressesData, $address): array
    {
        $idsOldAddress = array_map(function($addressBd){
            if($addressBd['id']){
                return $addressBd['id'];
            }
        }, $addressesData);

        $idsNewAddress = array_filter(
            array_map(function($address){
                if(!empty($address['id'])){
                    return $address['id'];
                }
            }, $address)
        );
        return array_diff($idsOldAddress, $idsNewAddress);
    }


}