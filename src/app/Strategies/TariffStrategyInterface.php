<?php

namespace App\Strategies;

interface TariffStrategyInterface
{
    /**
     * Check if the tariff is supported
     *
     * @param $tariff
     * @return bool
     */
    public function supports($tariff): bool;

    /**
     * Calculate annual consumption costs for a given tariff
     *
     * @param $tariff
     * @param int $annualConsumption
     * @return float
     */
    public function calculateAnnualConsumptionCosts($tariff, int $annualConsumption): float;
}
