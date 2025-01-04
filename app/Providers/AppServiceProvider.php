<?php

namespace App\Providers;

use Src\Currency\Application\Buses\QueryBus;
use Src\Currency\Application\Commands\UpdateRatesCommand;
use Src\Currency\Application\Handlers\GetCurrenciesQueryHandler;
use Src\Currency\Application\Handlers\GetRateConversionQueryHandler;
use Src\Currency\Application\Handlers\UpdateRatesCommandHandler;
use Src\Currency\Application\Queries\GetCurrenciesQuery;
use Src\Currency\Application\Queries\GetRateConversionQuery;
use Src\Currency\Application\Services\UpdateRatesService;
use Src\Currency\Domain\Interfaces\CurrencyRepositoryInterface;
use Src\Currency\Domain\Interfaces\ExchangeRateProviderInterface;
use Illuminate\Support\ServiceProvider;
use Src\Currency\Domain\Interfaces\RateHistoryRepositoryInterface;
use Src\Currency\Domain\Interfaces\RateRepositoryInterface;
use Src\Currency\Infrastructure\Persistence\DBCurrencyRepository;
use Src\Currency\Infrastructure\Persistence\DBRateHistoryRepository;
use Src\Currency\Infrastructure\Persistence\DBRateRepository;
use Src\Currency\Infrastructure\Services\FixerApiAdapter;
use Src\Currency\Application\Buses\CommandBus;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ExchangeRateProviderInterface::class, function ($app) {
            return new FixerApiAdapter(
                env('FIXER_API_KEY'), env('FIXER_API_URL')
            );
        });

        $this->app->singleton(QueryBus::class);

        $this->app->resolving(QueryBus::class, function (QueryBus $queryBus, $app) {
            $queryBus->register(
                GetRateConversionQuery::class,
                $app->make(GetRateConversionQueryHandler::class)
            );
            $queryBus->register(
                GetCurrenciesQuery::class,
                $app->make(GetCurrenciesQueryHandler::class)
            );
        });

        $this->app->singleton(CommandBus::class);

        $this->app->singleton(CommandBus::class, function ($app) {
            $commandBus = new CommandBus();
            $commandBus->register(
                UpdateRatesCommand::class,
                $app->make(UpdateRatesCommandHandler::class)
            );
            return $commandBus;
        });


        $this->app->singleton(
            RateRepositoryInterface::class,
            DBRateRepository::class
        );
        $this->app->singleton(
            CurrencyRepositoryInterface::class,
            DBCurrencyRepository::class
        );
        $this->app->singleton(
            RateHistoryRepositoryInterface::class,
            DBRateHistoryRepository::class
        );

        $this->app->singleton(
            UpdateRatesService::class,
            function ($app) {
                return new UpdateRatesService(
                    $app->make(ExchangeRateProviderInterface::class),
                    $app->make(RateRepositoryInterface::class),
                    $app->make(CurrencyRepositoryInterface::class),
                    $app->make(RateHistoryRepositoryInterface::class)
                );
            }
        );


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
