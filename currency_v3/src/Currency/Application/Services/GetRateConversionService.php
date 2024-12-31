<?php

declare(strict_types=1);

namespace Src\Currency\Application\Services;

use Src\Currency\Domain\Interfaces\ExchangeRateProviderInterface;
use Src\Currency\Domain\ValueObjects\CurrencyConversionRequest;

class GetRateConversionService
{
    private ExchangeRateProviderInterface $exchangeRateProvider;

    public function __construct(ExchangeRateProviderInterface $exchangeRateProvider)
    {
        $this->exchangeRateProvider = $exchangeRateProvider;
    }

    public function __invoke(CurrencyConversionRequest $conversionRequest): array
    {
        $rate = $this->exchangeRateProvider->getRate(
            $conversionRequest->fromCurrency(),
            $conversionRequest->toCurrency()
        );
        return [
            'from'=>$conversionRequest->fromCurrency(),
            'to'=>$conversionRequest->toCurrency(),
            'amount'=>$conversionRequest->amount(),
            'result'=>$conversionRequest->amount() * $rate,
        ];
    }
}
