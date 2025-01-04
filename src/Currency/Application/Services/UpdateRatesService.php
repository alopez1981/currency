<?php

declare (strict_types=1);

namespace Src\Currency\Application\Services;

use Src\Currency\Domain\Entities\RateHistory;
use Src\Currency\Domain\Interfaces\CurrencyRepositoryInterface;
use Src\Currency\Domain\Interfaces\ExchangeRateProviderInterface;
use Src\Currency\Domain\Interfaces\RateRepositoryInterface;
use Src\Currency\Domain\ValueObjects\BaseCurrency;
use Src\Currency\Domain\Interfaces\RateHistoryRepositoryInterface;

class UpdateRatesService
{
    private ExchangeRateProviderInterface $exchangeRateProvider;
    private RateRepositoryInterface $rateRepository;
    private CurrencyRepositoryInterface $currencyRepository;
    private RateHistoryRepositoryInterface $rateHistoryRepository;

    public function __construct(
        ExchangeRateProviderInterface $exchangeRateProvider,
        RateRepositoryInterface $rateRepository,
        CurrencyRepositoryInterface $currencyRepository,
        RateHistoryRepositoryInterface $rateHistoryRepository
    ){
        $this->exchangeRateProvider = $exchangeRateProvider;
        $this->rateRepository = $rateRepository;
        $this->currencyRepository = $currencyRepository;
        $this->rateHistoryRepository = $rateHistoryRepository;
    }

    public function __invoke(BaseCurrency $baseCurrency): void
    {
        $currencies = $this->currencyRepository->getAll();
            foreach ($currencies as $currency) {

                if ($currency->getCode()->getCode() !== $baseCurrency->getCode()) {

                    $rate = $this->exchangeRateProvider->getRate(
                        $baseCurrency->getCode(),
                        $currency->getCode()->getCode()
                    );
                    $this->rateRepository->updateOrInsertRate(
                        $baseCurrency->getCode(),
                        $currency->getCode()->getCode(),
                        $rate
                    );
                    $rateHistory = new RateHistory(
                        $baseCurrency->getCode(),
                        $currency->getCode(),
                        $rate,
                        new \DateTimeImmutable()
                    );
                    $this->rateHistoryRepository->save($rateHistory);
                }
            }
    }
}
