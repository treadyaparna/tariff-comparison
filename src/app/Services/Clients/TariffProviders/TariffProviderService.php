<?php

namespace App\Services\Clients\TariffProviders;

use App\Services\Clients\TariffProviders\DataTransferObjects\TariffDTOFactory;
use Exception;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Support\Collection;
use RuntimeException;

class TariffProviderService
{
    protected string $tariffProviderUri;

    public function __construct(private readonly HttpClient $httpClient)
    {
        $this->tariffProviderUri = config('services.tariff.uri');
    }

    /**
     * Get the tariffs from the external tariff provider service
     *
     * @return Collection
     */
    public function getTariffs(): Collection
    {
        $tariffs = $this->fetchTariffs();

        return $this->transformTariffs($tariffs);
    }

    /**
     * Fetch the data from the external tariff provider service
     *
     * @return array
     */
    private function fetchTariffs(): array
    {
        try {
            $response = $this->httpClient->get($this->tariffProviderUri);
            if ($response->successful()) {
                $tariffs = $response->json();
                if (!is_array($tariffs)) {
                    throw new RuntimeException('Invalid data received from the tariff provider service');
                }
                return $tariffs;
            } else {
                throw new RuntimeException('Tariff provider service returned an error');
            }
        } catch (Exception $e) {
            throw new RuntimeException('Error fetching data from the tariff provider service: ' . $e->getMessage());
        }
    }

    /**
     * Transform the data into a collection of TariffDTO objects
     *
     * @param array $tariffs
     * @return Collection
     */
    private function transformTariffs(array $tariffs): Collection
    {
        return collect($tariffs)
            ->map(fn(array $tariff) => TariffDTOFactory::create($tariff));
    }
}
