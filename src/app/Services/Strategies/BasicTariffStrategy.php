<?php
// app/Services/Strategies/ElectronicDiscountStrategy.php

namespace App\Services\Strategies;

use App\Services\Clients\Tariff\DataTransferObjects\BasicElectricityTariffDTO;

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
        // Check if the tariff is an instance of BasicElectricityTariffDTO
        return $tariff instanceof BasicElectricityTariffDTO;
    }

    /**
     * Calculate annual consumption costs for a Basic Package Tariff
     *
     * @param BasicElectricityTariffDTO $tariff
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
