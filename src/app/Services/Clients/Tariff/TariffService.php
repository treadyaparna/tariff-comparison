<?php
namespace App\Services\Clients\Tariff;

use App\Services\Clients\Tariff\DataTransferObjects\TariffDTOFactory;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Support\Collection;

class TariffService
{
    private HttpClient $httpClient;
    private string $tariffUri;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->tariffUri = config('services.tariff.uri');
    }

    /**
     * @return Collection
     */
    public function getTariffs(): Collection
    {
        //TO DO: try catch block
        $products = $this->fetchData();

        return $this->transformData($products);
    }

    private function fetchData(): array
    {
        $response = $this->httpClient->get($this->tariffUri);
        if ($response->successful()) {
            $data = $response->json();
        } else {
            // Handle the error...
            throw new \RuntimeException('Server error');
        }

        // Validate the data
        if (!is_array($data)) {
            throw new \RuntimeException('Invalid data format');
        }

        return $data;
    }

    private function transformData(array $data): Collection
    {
        return collect($data)
            ->map(fn (array $item) => TariffDTOFactory::create($item));
    }
}
