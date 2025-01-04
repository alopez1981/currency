<?php

declare (strict_types=1);

namespace Src\Currency\Domain\Entities;

class RateHistory
{
    private string $baseCurrency;
    private string $targetCurrency;

    private float $rate;

    private \DateTimeImmutable $date;

    public function __construct(string $baseCurrency, string $targetCurrency, float $rate, \DateTimeImmutable $date)
    {
        $this->baseCurrency = $baseCurrency;
        $this->targetCurrency = $targetCurrency;
        $this->rate = $rate;
        $this->date = $date;
    }

    public function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    public function getTargetCurrency(): string
    {
        return $this->targetCurrency;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}
