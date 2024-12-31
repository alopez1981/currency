<?php

declare(strict_types=1);

namespace Src\Currency\Infrastructure\Services;

use Src\Currency\Domain\Interfaces\ExchangeRateProviderInterface;
use Illuminate\Support\Facades\Http;

class FixerApiAdapter implements ExchangeRateProviderInterface
{
    private string $apiKey;
    private string $apiUrl;

    public function __construct(string $apiKey, string $apiUrl)
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
    }

    public function getRate(string $fromCurrency, string $toCurrency): float
    {
        if($fromCurrency !== 'EUR') {
            throw new \InvalidArgumentException('From currency is not EUR');
        }
        $response = Http::get($this->apiUrl, [
            'access_key' => $this->apiKey,
            'base' =>$fromCurrency,
            'symbols' => $toCurrency,
        ]);
        if ($response->failed() || !isset($response->json('rates')[$toCurrency])) {
            throw new \RuntimeException('Failed to get rate');
        }
        return (float)$response->json('rates')[$toCurrency];
    }
}
