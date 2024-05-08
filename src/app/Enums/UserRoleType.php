<?php

namespace App\Enums;

use ReflectionClass;

class UserRoleType
{
    const ADMINISTRATOR = 1;
    const PASSENGER = 2;

    public static function getValues(): array
    {
        $reflectionClass = new ReflectionClass(static::class);
        return array_values($reflectionClass->getConstants());
    }

    public static function valueOf($value)
    {
        $constants = static::getConstants();

        if (in_array($value, $constants)) {
            return $value;
        }

        return null;
    }

    private static function getConstants()
    {
        $reflectionClass = new ReflectionClass(static::class);
        return array_values($reflectionClass->getConstants());
    }
}
