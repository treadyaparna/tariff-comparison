<?php

namespace Tests\Unit;

use App\Enums\HttpStatus;
use App\Services\Clients\TariffProviders\TariffProviderService;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Support\Collection;
use Mockery;
use RuntimeException;
use Tests\TestCase;

class TariffProviderServiceTest extends TestCase
{
    private $httpClient;
    private $tariffProviderService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->httpClient = Mockery::mock(HttpClient::class);
        $this->tariffProviderService = new TariffProviderService($this->httpClient);
    }

    public function testGetTariffs()
    {
        $tariffs = [[
            'name' => 'basic-tariff',
            'type' => 1,
            'baseCost' => 5,
            'additionalKwhCost' => 22
        ], [
            'name' => 'packaged-tariff',
            'type' => 2,
            'baseCost' => 800,
            'additionalKwhCost' => 30,
            'includedKwh' => 4000
        ]];

        $this->httpClient->shouldReceive('get')->andReturnSelf();
        $this->httpClient->shouldReceive('successful')->andReturn(true);
        $this->httpClient->shouldReceive('json')->andReturn($tariffs);

        $result = $this->tariffProviderService->getTariffs();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(2, $result);
    }

    public function testInvalidTypeTariff()
    {
        $tariffs = [
            ['name' => 'Tariff1', 'baseCost' => 5, 'additionalKwhCost' => 22, 'type' => 3]
        ];

        $this->httpClient->shouldReceive('get')->andReturnSelf();
        $this->httpClient->shouldReceive('successful')->andReturn(true);
        $this->httpClient->shouldReceive('json')->andReturn($tariffs);

        $this->expectExceptionMessage('Invalid tariff type provided');
        $this->tariffProviderService->getTariffs();
    }

    public function testNoTypeTariff()
    {
        $tariffs = [
            ['name' => 'Tariff1', 'baseCost' => 5, 'additionalKwhCost' => 22]
        ];

        $this->httpClient->shouldReceive('get')->andReturnSelf();
        $this->httpClient->shouldReceive('successful')->andReturn(true);
        $this->httpClient->shouldReceive('json')->andReturn($tariffs);

        $this->expectExceptionMessage('The `type` must be provided in the tariff data.');
        $this->tariffProviderService->getTariffs();
    }

    public function testInvalidDataTariff()
    {
        $tariffs = 'invalid data';

        $this->httpClient->shouldReceive('get')->andReturnSelf();
        $this->httpClient->shouldReceive('successful')->andReturn(true);
        $this->httpClient->shouldReceive('json')->andReturn($tariffs);

        $this->expectExceptionMessage(HttpStatus::MESSAGES[HttpStatus::INVALID_TARIFF_PROVIDER_ERROR]);
        $this->tariffProviderService->getTariffs();
    }

    public function testErrorFetchingData()
    {
        $this->httpClient->shouldReceive('get')->andReturnSelf();

        $this->expectExceptionMessage(HttpStatus::MESSAGES[HttpStatus::TARIFF_PROVIDER_ERROR]);
        $this->tariffProviderService->getTariffs();
    }

    public function testErrorFetchingDataException()
    {
        $this->httpClient->shouldReceive('get')->andThrow(new RuntimeException());

        $this->expectExceptionMessage(HttpStatus::MESSAGES[HttpStatus::TARIFF_PROVIDER_ERROR]);
        $this->tariffProviderService->getTariffs();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
