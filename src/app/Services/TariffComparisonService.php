<?php

namespace App\Services;

use App\Services\Clients\Tariff\TariffService;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class TariffComparisonService
{
    public function __construct(
        private readonly TariffService $tariffService,
        protected array $strategies
    ) {}

    /**
     * Calculate the consumption for a given tariff
     *
     * @param $tariff
     * @param $consumption
     * @return float
     */
    public function calculateAnnualConsumptionCosts($tariff, $consumption): float
    {
        if (empty($this->strategies)) {
            throw new InvalidArgumentException('No strategies provided for tariff calculation.');
        }

        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($tariff)) {
                return $strategy->calculateAnnualConsumptionCosts($tariff, $consumption);
            }
        }

        throw new InvalidArgumentException('Invalid product type for tariff calculation.');
    }

    /**
     * Calculate the annual costs for all tariffs based on the consumption
     *
     * @param float $consumption
     * @return Collection
     */
    public function calculateAnnualCosts(float $consumption): Collection
    {
        // Get all tariffs
        $tariffs = $this->tariffService->getTariffs();

        // Calculate the annual cost for each tariff based on the consumption
        // todo: do sorting here
        return collect($tariffs)
            ->map(function ($tariff) use ($consumption) {
                $calculatedCosts = $this->calculateAnnualConsumptionCosts($tariff, $consumption);
                return [
                    'tariffName' => $tariff->name, // Assuming tariff object has a 'name' property
                    'annualCosts' => $calculatedCosts,
                ];
            });
    }


}
