<?php

declare(strict_types=1);

namespace Src\Currency\Application\Queries;

class GetRateConversionQuery
{
    private $fromCurrency;
    private $toCurrency;
    private $amount;

    public function __construct(string $fromCurrency, string $toCurrency, float $amount)
    {
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
