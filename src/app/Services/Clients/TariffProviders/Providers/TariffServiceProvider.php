<?php
namespace App\Services\Clients\TariffProviders\Providers;

use App\Services\Clients\TariffProviders\TariffProviderService;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Support\ServiceProvider;

class TariffServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TariffProviderService::class, function ($app) {
            return new TariffProviderService($app->make(HttpClient::class));
        });
    }
}
