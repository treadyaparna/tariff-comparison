<?php
namespace App\Services\Clients\Tariff\DataTransferObjects;

class TariffDTOFactory
{
    public static function create(array $data): BaseTariffDTO
    {
        return match ($data['type']) {
            2 => new PackagedTariffDTO($data),
            default => new BasicElectricityTariffDTO($data),
        };
    }
}
