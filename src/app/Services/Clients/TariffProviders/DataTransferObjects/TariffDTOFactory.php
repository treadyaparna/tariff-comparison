<?php
namespace App\Services\Clients\TariffProviders\DataTransferObjects;

use InvalidArgumentException;

class TariffDTOFactory
{
    const BASIC_TARIFF = 1;
    const PACKAGED_TARIFF = 2;

    public static function create(array $tariff): BaseTariffDTO
    {
        if (!isset($tariff['type'])) {
            throw new InvalidArgumentException('The `type` must be provided in the tariff data.');
        }

        return match ($tariff['type']) {
            self::BASIC_TARIFF => new BasicTariffDTO($tariff),
            self::PACKAGED_TARIFF => new PackagedTariffDTO($tariff),
            default => throw new InvalidArgumentException('Invalid tariff type provided.'),
        };
    }
}
