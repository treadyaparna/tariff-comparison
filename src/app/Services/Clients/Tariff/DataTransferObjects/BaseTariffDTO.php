<?php
namespace App\Services\Clients\Tariff\DataTransferObjects;

use App\Services\Clients\Tariff\ValueObjects\Price;

class BaseTariffDTO
{
    public readonly string $name;
    public readonly string $type;
    public readonly Price $baseCost;
    public readonly Price $additionalKwhCost;
    public function __construct($data) {
        $this->name = $data['name'];
        $this->type = $data['type'];
        $this->baseCost = Price::fromEuros($data['baseCost']);
        $this->additionalKwhCost = Price::fromCents($data['additionalKwhCost']);
    }

    public function getType(): string {
        return $this->type;
    }

    public function getName(): string {
        return $this->name;
    }
}

