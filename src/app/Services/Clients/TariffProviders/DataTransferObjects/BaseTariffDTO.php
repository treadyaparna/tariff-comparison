<?php
namespace App\Services\Clients\TariffProviders\DataTransferObjects;

use App\Helpers\PriceFormatter;

class BaseTariffDTO
{
    public readonly string $name;
    public readonly string $type;
    public readonly PriceFormatter $baseCost;
    public readonly PriceFormatter $additionalKwhCost;
    public function __construct($tariff) {
        $this->name = $tariff['name'];
        $this->type = $tariff['type'];
        $this->baseCost = PriceFormatter::fromEuros($tariff['baseCost']);
        $this->additionalKwhCost = PriceFormatter::fromCents($tariff['additionalKwhCost']);
    }

    public function getType(): string {
        return $this->type;
    }

    public function getName(): string {
        return $this->name;
    }
}

