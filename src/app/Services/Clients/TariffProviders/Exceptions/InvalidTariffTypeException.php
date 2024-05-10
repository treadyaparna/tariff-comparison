<?php

namespace App\Services\Clients\TariffProviders\Exceptions;

use App\Enums\HttpStatus;
use Exception;

class InvalidTariffTypeException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            HttpStatus::MESSAGES[HttpStatus::INVALID_TARIFF_TYPE], // message
            HttpStatus::HTTP_NOT_FOUND // code
        );
    }
}
