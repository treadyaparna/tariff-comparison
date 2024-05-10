<?php

namespace App\Services\Clients\TariffProviders;

use App\Services\Clients\TariffProviders\DataTransferObjects\TariffDTOFactory;
use App\Services\Clients\TariffProviders\Exceptions\InvalidTariffProviderException;
use App\Services\Clients\TariffProviders\Exceptions\TariffProviderException;
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
        try {
            $tariffs = $this->fetchTariffs();
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode());
        }

        return $this->transformTariffs($tariffs);
    }

    /**
     * Fetch the data from the external tariff provider service
     *
     * @return array
     * @throws TariffProviderException|InvalidTariffProviderException
     */
    private function fetchTariffs(): array
    {
        $response = $this->httpClient->get($this->tariffProviderUri);
        if ($response->successful()) {
            $tariffs = $response->json();

            if (!is_array($tariffs)) {
                throw new InvalidTariffProviderException();
            }

            return $tariffs;
        }
        throw new TariffProviderException();
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
