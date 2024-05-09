<?php
namespace App\Services\Clients\TariffProviders\DataTransferObjects;

class TariffTypeDTOFactory
{
    public static function create(array $data): TariffTypeDTO
    {
        return new TariffTypeDTO($data);
    }
}
