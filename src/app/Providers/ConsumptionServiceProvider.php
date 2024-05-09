<?php
// app/Providers/DiscountServiceProvider.php

namespace App\Providers;

use App\Services\Clients\Tariff\TariffService;
use Illuminate\Support\ServiceProvider;
use App\Services\TariffComparisonService;
use App\Services\Strategies\BasicTariffStrategy;
use App\Services\Strategies\PackageTariffStrategy;

class ConsumptionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TariffComparisonService::class, function ($app) {

            // add tariff strategies
            $strategies = [
                new BasicTariffStrategy(),
                new PackageTariffStrategy(),
            ];

            return new TariffComparisonService($app->make(TariffService::class), $strategies);
        });
    }
}
