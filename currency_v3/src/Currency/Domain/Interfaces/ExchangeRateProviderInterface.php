<?php

declare(strict_types=1);

namespace Src\Currency\Domain\Interfaces;

interface ExchangeRateProviderInterface
{
    public function getRate(string $fromCurrency, string $toCurrency): float;
}
