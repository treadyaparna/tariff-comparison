<?php

namespace App\Exceptions;

use App\Enums\HttpStatus;
use Exception;


class NoTariffsException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            HttpStatus::MESSAGES[HttpStatus::NO_TARIFFS_AVAILABLE], // message
            HttpStatus::HTTP_NOT_FOUND // code
        );
    }
}
