<?php

namespace App\Services;

use App\Exceptions\NoStrategiesException;
use App\Exceptions\NoTariffsException;
use App\Services\Clients\TariffProviders\TariffProviderService;
use Exception;
use Illuminate\Support\Collection;

class TariffComparisonService
{
    public function __construct(
        private readonly TariffProviderService $tariffService,
        protected array                        $strategies
    ) {}

    /**
     * Calculate the consumption for a given tariff
     *
     * @param $tariff
     * @param $annualConsumption
     * @return float
     * @throws NoStrategiesException|NoTariffsException
     */
    public function calculateAnnualConsumptionCosts($tariff, $annualConsumption): float
    {
        if ($this->strategies === [] || empty($this->strategies)) {
            throw new NoStrategiesException();
        }

        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($tariff)) {
                return $strategy->calculateAnnualConsumptionCosts($tariff, $annualConsumption);
            }
        }

        throw new NoTariffsException();
    }

    /**
     * Calculate the annual costs for all tariffs based on the consumption
     *
     * @param int $annualConsumption
     * @return Collection
     * @throws Exception
     */
    public function calculateAnnualCosts(int $annualConsumption): Collection
    {
        // Get all tariffs
        $tariffs = $this->tariffService->getTariffs();
        if ($tariffs->isEmpty()) {
            throw new NoTariffsException();
        }

        // Calculate the annual cost for each tariff based on the consumption
        return collect($tariffs)
            ->map(function ($tariff) use ($annualConsumption) {
                $calculatedCosts = $this->calculateAnnualConsumptionCosts($tariff, $annualConsumption);
                return [
                    'tariffName' => $tariff->name,
                    'annualCosts' => $calculatedCosts,
                ];
            })->sortBy('annualCosts')->values();
    }


}
