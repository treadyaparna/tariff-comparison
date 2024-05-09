<?php

namespace App\Services\Clients\TariffProviders\ValueObjects;

class Price
{
    public function __construct(
        public readonly int $cents,
        public readonly float $euros,
        public readonly string $formatted,
    ) {}

    public static function fromCents(int $cents): self
    {
        return new self(
            cents: $cents,
            euros: $cents / 100,
            formatted: '€' . number_format($cents / 100, 2),
        );
    }

    public static function fromEuros(int $euros): self
    {
        return new self(
            cents: $euros * 100,
            euros: $euros ,
            formatted: '€' . number_format($euros * 100, 2),
        );
    }
}
