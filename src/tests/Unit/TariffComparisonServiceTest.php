<?php

namespace Tests\Unit;

use App\Enums\HttpStatus;
use App\Exceptions\NoTariffsException;
use App\Services\Clients\TariffProviders\DataTransferObjects\BasicTariffDTO;
use App\Services\Clients\TariffProviders\DataTransferObjects\PackagedTariffDTO;
use App\Services\Clients\TariffProviders\TariffProviderService;
use App\Services\TariffComparisonService;
use App\Strategies\TariffStrategyInterface;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class TariffComparisonServiceTest extends TestCase
{
    private $tariffService;
    private $strategies;
    private $tariffComparisonService;
    private $basicTariff;
    private $packagedTariff;
    private $tariffs;

    public function setUp(): void
    {
        parent::setUp();

        $this->tariffService = Mockery::mock(TariffProviderService::class);
        $this->strategies = [Mockery::mock(TariffStrategyInterface::class)];
        $this->tariffComparisonService = new TariffComparisonService(
            $this->tariffService,
            $this->strategies
        );

        $basicTariff = [
            'name' => 'basic-tariff',
            'type' => 1,
            'baseCost' => 5,
            'additionalKwhCost' => 22
        ];
        $this->basicTariff = new BasicTariffDTO($basicTariff);

        $packagedTariff = [
            'name' => 'packaged-tariff',
            'type' => 2,
            'baseCost' => 800,
            'additionalKwhCost' => 30,
            'includedKwh' => 4000
        ];
        $this->packagedTariff = new PackagedTariffDTO($packagedTariff);
        $this->tariffs = collect([$this->basicTariff, $this->packagedTariff]);
    }

    public function testCalculateAnnualConsumptionCosts()
    {
        $annualConsumption = 1000;

        $this->strategies[0]->shouldReceive('supports')->with($this->basicTariff)->andReturn(true);
        $this->strategies[0]->shouldReceive('calculateAnnualConsumptionCosts')
            ->with($this->basicTariff, $annualConsumption)->andReturn(1200.00);

        $result = $this->tariffComparisonService->calculateAnnualConsumptionCosts(
            $this->basicTariff,
            $annualConsumption
        );

        $this->assertEquals(1200.00, $result);
    }

    public function testCalculateAnnualCosts()
    {
        $annualConsumption = 1000;
        $this->tariffService->shouldReceive('getTariffs')->andReturn($this->tariffs);
        $this->strategies[0]->shouldReceive('supports')->andReturn(true);
        $this->strategies[0]->shouldReceive('calculateAnnualConsumptionCosts')->andReturn(1200.00, 1300.00);

        $result = $this->tariffComparisonService->calculateAnnualCosts($annualConsumption);

        $this->assertCount(2, $result);
        $this->assertEquals(1200.00, $result[0]['annualCosts']);
        $this->assertEquals(1300.00, $result[1]['annualCosts']);
    }

    public function testCalculateAnnualCostsWithNoStrategies()
    {
        $this->expectException(Exception::class);

        $this->tariffComparisonService = new TariffComparisonService($this->tariffService, []);
        $this->tariffComparisonService->calculateAnnualCosts(1000);
    }

    public function testCalculateAnnualCostsWithNoTariff()
    {
        $this->expectException(NoTariffsException::class);
        $this->expectExceptionMessage(HttpStatus::MESSAGES[HttpStatus::NO_TARIFFS_AVAILABLE]);

        $this->tariffService->shouldReceive('getTariffs')->andReturn($this->tariffs);
        $this->strategies[0]->shouldReceive('supports')->andReturn(false);

        $this->tariffComparisonService->calculateAnnualCosts(1000);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
