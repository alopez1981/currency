<?php

namespace App\Providers;

use Src\Currency\Application\Buses\QueryBus;
use Src\Currency\Application\Handlers\GetRateConversionQueryHandler;
use Src\Currency\Application\Queries\GetRateConversionQuery;
use Src\Currency\Domain\Interfaces\ExchangeRateProviderInterface;
use Illuminate\Support\ServiceProvider;
use Src\Currency\Infrastructure\Services\FixerApiAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ExchangeRateProviderInterface::class, function ($app) {
            return new FixerApiAdapter(
                env('FIXER_API_KEY'),
            env('FIXER_API_URL')
            );
        });
        $this->app->singleton(QueryBus::class);

        $this->app->resolving(QueryBus::class, function (QueryBus $queryBus, $app) {
            $queryBus->register(
                GetRateConversionQuery::class,
                $app->make(GetRateConversionQueryHandler::class)
            );
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
