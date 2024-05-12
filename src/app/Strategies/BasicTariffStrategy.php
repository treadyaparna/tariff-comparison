<?php

namespace App\Strategies;

use App\Services\Clients\TariffProviders\DataTransferObjects\BasicTariffDTO;

class BasicTariffStrategy implements TariffStrategyInterface
{
    /**
     * Check if the tariff is supported the Basic Package Tariff
     *
     * @param $tariff
     * @return bool
     */
    public function supports($tariff): bool
    {
        // Check if the tariff is an instance of BasicTariffDTO
        return $tariff instanceof BasicTariffDTO;
    }

    /**
     * Calculate annual consumption costs for a Basic Package Tariff
     *
     * @param BasicTariffDTO $tariff
     * @param int $annualConsumption
     * @return float
     */
    public function calculateAnnualConsumptionCosts($tariff, int $annualConsumption): float
    {
        $baseAnnualCost = $tariff->baseCost->euros * 12;
        $additionalKwhAnnualCost = $tariff->additionalKwhCost->euros * $annualConsumption;
        return $baseAnnualCost + $additionalKwhAnnualCost;
    }
}
