<?php

namespace App\Services\Clients\TariffProviders\Exceptions;

use App\Enums\HttpStatus;
use Exception;

class TariffProviderException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            HttpStatus::MESSAGES[HttpStatus::TARIFF_PROVIDER_ERROR], // message
            HttpStatus::HTTP_NOT_FOUND // code
        );
    }
}
