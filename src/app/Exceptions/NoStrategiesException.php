<?php

namespace App\Exceptions;

use App\Enums\HttpStatus;
use Exception;


class NoStrategiesException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            HttpStatus::MESSAGES[HttpStatus::NO_STRATEGY_AVAILABLE], // message
            HttpStatus::HTTP_NOT_FOUND // code
        );
    }
}
