<?php
namespace App\Services\Clients\TariffProviders\DataTransferObjects;
class TariffTypeDTO {
    public readonly string $type;
    public readonly string $name;

    public function __construct($data) {
        $this->type = $data['type'];
        $this->name = $data['name'] ?? null;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getName(): ?string {
        return $this->name;
    }

}
