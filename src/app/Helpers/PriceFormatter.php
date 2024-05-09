<?php

namespace App\Helpers;

readonly class PriceFormatter
{
    public function __construct(
        public int    $cents,
        public float  $euros,
        public string $formatted,
    ) {}

    public static function fromCents(int $cents): self
    {
        return new self(
            cents: $cents,
            euros: $cents / 100,
            formatted: '€' . number_format($cents / 100, 2),
        );
    }

    public static function fromEuros(float $euros): self
    {
        return new self(
            cents: $euros * 100,
            euros: $euros ,
            formatted: '€' . number_format($euros * 100, 2),
        );
    }
}
