<?php

namespace App\Services;

use App\Services\Clients\Tariff\TariffService;
use App\Services\Clients\Tariff\TariffTypeService;


class ComparisonService
{
    public function __construct(private TariffService $tariffService, private TariffTypeService $tariffTypeService) {}

    public function compareTariff($consumption)
    {

        return "Hello! I am ComparisonService. I am here to compare tariffs.";

    }

    public function getTariffs()
    {
        return $this->tariffService->getTariffs();
    }

    public function getTariffTypes()
    {
        return $this->tariffTypeService->getTariffTypes();
    }

}
