<?php
namespace App\Services\Clients\Tariff\DataTransferObjects;

class TariffTypeDTOFactory
{
    public static function create(array $data): TariffTypeDTO
    {
        return new TariffTypeDTO($data);
    }
}
