<?php

namespace App\Strategies;

use App\Services\Clients\TariffProviders\DataTransferObjects\PackagedTariffDTO;

class PackagedTariffStrategy implements TariffStrategyInterface
{
    /**
     * Check if the tariff is supported the package tariff
     *
     * @param $tariff
     * @return bool
     */
    public function supports($tariff): bool
    {
        // Check if the $tariffs is an instance of PackagedTariffDTO
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
     * @param int $annualConsumption
     * @return float
     */
    public function calculateAnnualConsumptionCosts($tariff, int $annualConsumption): float
    {
        // Calculate the base annual cost
        $baseAnnualCost = $tariff->baseCost->euros;

        // Check if the consumption is less than or equal to the included kWh
        if ($annualConsumption <= $tariff->includedKwh) {
            return $baseAnnualCost;
        } else { // Calculate the additional kWh cost
            $additionalConsumption = $annualConsumption - $tariff->includedKwh;
            $additionalKwhAnnualCost = $tariff->additionalKwhCost->euros * $additionalConsumption;
            return $baseAnnualCost + $additionalKwhAnnualCost;
        }
    }
}
