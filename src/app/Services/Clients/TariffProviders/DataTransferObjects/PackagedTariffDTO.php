<?php
namespace App\Services\Clients\TariffProviders\DataTransferObjects;

class PackagedTariffDTO extends BaseTariffDTO
{
    public readonly string $includedKwh;
    public function __construct($tariff) {
        parent::__construct($tariff);
        $this->includedKwh = $tariff['includedKwh'] ?? '';
    }

    public function getIncludedKwh(): string {
        return $this->includedKwh;
    }
}
