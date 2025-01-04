<?php

declare(strict_types=1);

namespace Src\Currency\Application\Handlers;

use Src\Currency\Application\Queries\GetRateConversionQuery;
use Src\Currency\Application\Services\GetRateConversionService;
use Src\Currency\Domain\ValueObjects\CurrencyConversionRequest;

class GetRateConversionQueryHandler
{
    private GetRateConversionService $service;

    public function __construct(GetRateConversionService $service)
    {
        $this->service = $service;
    }

    public function __invoke(GetRateConversionQuery $query): array
    {
        $conversionRequest = new CurrencyConversionRequest(
            $query->fromCurrency(),
            $query->toCurrency(),
            $query->amount()
        );
        return ($this->service)($conversionRequest);
    }
}
