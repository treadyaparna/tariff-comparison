<?php

namespace App\Services\Strategies;

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
     * @param int $consumption
     * @return float
     */
    public function calculateAnnualConsumptionCosts($tariff, int $consumption): float
    {
        // todo: check if the calculation is correct
        $baseAnnualCost = $tariff->baseCost->euros * 12;
        $additionalKwhAnnualCost = $tariff->additionalKwhCost->euros * $consumption;
        return $baseAnnualCost + $additionalKwhAnnualCost;
    }
}
