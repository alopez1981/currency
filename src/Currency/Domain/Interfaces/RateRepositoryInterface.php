<?php

namespace Src\Currency\Domain\Interfaces;

interface RateRepositoryInterface
{
    public function updateOrInsertRate( string $baseCurrency, string $targetCurrency, float $rate):void;
}
