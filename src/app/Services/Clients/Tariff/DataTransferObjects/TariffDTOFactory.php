<?php
namespace App\Services\Clients\Tariff\DataTransferObjects;

class TariffDTOFactory
{
    public static function create(array $data): BaseTariffDTO
    {
        switch ($data['type']) {
            case 2:
                return new PackagedTariffDTO($data);
            default:
                return new BasicElectricityTariffDTO($data);
        }
    }
}
