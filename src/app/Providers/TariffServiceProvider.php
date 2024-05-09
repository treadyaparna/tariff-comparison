<?php
namespace App\Providers;

use App\Services\Clients\Tariff\TariffService;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Support\ServiceProvider;

class TariffServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TariffService::class, function ($app) {
            return new TariffService($app->make(HttpClient::class));
        });
    }
}
