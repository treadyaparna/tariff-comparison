<?php
// app/Services/Strategies/ElectronicDiscountStrategy.php

namespace App\Services\Strategies;

use App\Services\Clients\Tariff\DataTransferObjects\PackagedTariffDTO;

class PackageTariffStrategy implements TariffStrategyInterface
{
    /**
     * Check if the tariff is supported the package tariff
     *
     * @param $tariff
     * @return bool
     */
    public function supports($tariff): bool
    {
        // Check if the product is an instance of ClothingProduct
        return $tariff instanceof PackagedTariffDTO;
    }

    /**
     * Calculate annual consumption costs for a Packaged Tariff
     *
     * if the consumption is less than or equal to the included kWh, return the base annual cost
     * if the consumption is greater than the included kWh, return the base annual cost + additional kWh cost
     * use the formula: base annual cost + (consumption - included kWh) * additional kWh cost
     *
     * @param PackagedTariffDTO $tariff
     * @param int $consumption
     * @return float
     */
    public function calculateAnnualConsumptionCosts($tariff, int $consumption): float
    {
        // TODO: Check if the calculation is correct
        // Calculate the base annual cost
        $baseAnnualCost = $tariff->baseCost->euros;

        // Check if the consumption is less than or equal to the included kWh
        if ($consumption <= $tariff->includedKwh) {
            return $baseAnnualCost;
        } else { // Calculate the additional kWh cost
            $addtionalConsumption = $consumption - $tariff->includedKwh;
            $additionalKwhAnnualCost = $tariff->additionalKwhCost->euros * $addtionalConsumption;
            return $baseAnnualCost + $additionalKwhAnnualCost;
        }
    }
}
