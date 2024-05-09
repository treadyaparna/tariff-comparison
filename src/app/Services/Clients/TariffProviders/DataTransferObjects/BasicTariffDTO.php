<?php
namespace App\Services\Clients\TariffProviders\DataTransferObjects;


class BasicTariffDTO extends BaseTariffDTO
{
    public function __construct($tariff) {
        parent::__construct($tariff);
    }
}
