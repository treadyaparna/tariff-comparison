<?php

namespace App\Enums;


use ReflectionClass;

abstract class DatabaseTransactionState
{
    const START_TRANSACTION = 'START_TRANSACTION';
    const ROLLBACK_TRANSACTION = 'ROLLBACK_TRANSACTION';
    const COMMIT_TRANSACTION = 'COMMIT_TRANSACTION';
}
