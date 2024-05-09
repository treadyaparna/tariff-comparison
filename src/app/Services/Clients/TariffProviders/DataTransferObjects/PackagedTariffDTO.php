<?php
namespace App\Services\Clients\TariffProviders\DataTransferObjects;

class PackagedTariffDTO extends BaseTariffDTO
{
    public readonly string $includedKwh;
    public function __construct($data) {
        parent::__construct($data);
        $this->includedKwh = $data['includedKwh'] ?? '';
    }

    public function getIncludedKwh(): string {
        return $this->includedKwh;
    }
}
