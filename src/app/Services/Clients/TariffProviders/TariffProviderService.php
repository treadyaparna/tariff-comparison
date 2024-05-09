<?php

namespace App\Services\Clients\TariffProviders;

use App\Services\Clients\TariffProviders\DataTransferObjects\TariffDTOFactory;
use Exception;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Support\Collection;
use RuntimeException;

class TariffProviderService
{
    private string $tariffProviderUri;

    public function __construct(private readonly HttpClient $httpClient) {
        $this->tariffProviderUri = config('services.tariff.uri');
    }

    /**
     * Get the tariffs from the external tariff provider service
     *
     * @return Collection
     */
    public function getTariffs(): Collection
    {
        try {
            $products = $this->fetchData();
        } catch (Exception $e) {
            // Log the error
            // Return a default value
            return collect([]);
        }

        return $this->transformData($products);
    }

    /**
     * Fetch the data from the external tariff provider service
     *
     * @return array
     */
    private function fetchData(): array
    {
        $response = $this->httpClient->get($this->tariffProviderUri);
        if ($response->successful()) {
            $tariffs = $response->json();
        } else {
            throw new RuntimeException('Tariff provider service is not available');
        }

        if (!is_array($tariffs)) {
            throw new RuntimeException('Invalid data received from the tariff provider service');
        }

        return $tariffs;
    }

    /**
     * Transform the data into a collection of TariffDTO objects
     *
     * @param array $data
     * @return Collection
     */
    private function transformData(array $data): Collection
    {
        return collect($data)
            ->map(fn(array $item) => TariffDTOFactory::create($item));
    }
}
