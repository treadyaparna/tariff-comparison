<?php
namespace App\Services\Clients\TariffProviders\DataTransferObjects;

class TariffDTOFactory
{
    public static function create(array $data): BaseTariffDTO
    {
        return match ($data['type']) {
            2 => new PackagedTariffDTO($data),
            default => new BasicTariffDTO($data),
        };
    }
}
