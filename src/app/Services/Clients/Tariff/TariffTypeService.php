<?php
namespace App\Services\Clients\Tariff;

use App\Services\Clients\Tariff\DataTransferObjects\TariffTypeDTO;
use App\Services\Clients\Tariff\DataTransferObjects\TariffTypeDTOFactory;
use Illuminate\Support\Collection;

class TariffTypeService
{
    /**
     * @return Collection<TariffTypeDTO>
     */
    public function getTariffTypes(): Collection
    {
        $jsonString = file_get_contents(public_path('tariff_type.json'));
        $products = json_decode($jsonString, true);
        return collect($products)
            ->map(fn (array $data) => TariffTypeDTOFactory::create($data));
    }

}
