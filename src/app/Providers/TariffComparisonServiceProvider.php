<?php

namespace App\Providers;

use App\Services\Clients\TariffProviders\TariffProviderService;
use Illuminate\Support\ServiceProvider;
use App\Services\TariffComparisonService;
use App\Services\Strategies\BasicTariffStrategy;
use App\Services\Strategies\PackagedTariffStrategy;

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
