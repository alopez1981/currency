<?php

declare(strict_types=1);

namespace Src\Currency\Domain\ValueObjects;

final class CurrencyConversionRequest
{
    private string $fromCurrency;
    private string $toCurrency;
    private float $amount;

    public function __construct(string $fromCurrency, string $toCurrency, float $amount)
    {
        if($amount<=0){
            throw new \InvalidArgumentException('Amount must be a positive number');
        }
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;
        $this->amount = $amount;
    }

    public function fromCurrency(): string
    {
        return $this->fromCurrency;
    }

    public function toCurrency(): string
    {
        return $this->toCurrency;
    }

    public function amount(): float
    {
        return $this->amount;
    }
}
