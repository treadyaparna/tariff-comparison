<?php

namespace App\Services\Clients\Tariff;

use App\Services\Clients\Tariff\DataTransferObjects\TariffDTOFactory;
use Exception;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Support\Collection;
use RuntimeException;

class TariffService
{
    private string $tariffUri;

    public function __construct(private HttpClient $httpClient) {
        $this->tariffUri = config('services.tariff.uri');
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
        $response = $this->httpClient->get($this->tariffUri);
        if ($response->successful()) {
            $data = $response->json();
        } else {
            // Handle the error...
            throw new RuntimeException('Server error');
        }

        // Validate the data
        if (!is_array($data)) {
            throw new RuntimeException('Invalid data format');
        }

        return $data;
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
