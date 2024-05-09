<?php

namespace App\Providers;

use App\Services\Clients\TariffProviders\TariffProviderService;
use App\Services\TariffComparisonService;
use App\Strategies\BasicTariffStrategy;
use App\Strategies\PackagedTariffStrategy;
use Illuminate\Support\ServiceProvider;

class TariffComparisonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TariffComparisonService::class, function ($app) {

            // add tariff strategies
            $strategies = [
                new BasicTariffStrategy(),
                new PackagedTariffStrategy(),
            ];

            return new TariffComparisonService($app->make(TariffProviderService::class), $strategies);
        });
    }
}
