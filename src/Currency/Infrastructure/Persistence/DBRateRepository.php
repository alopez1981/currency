<?php

declare (strict_types=1);

namespace Src\Currency\Infrastructure\Persistence;

use Illuminate\Support\Facades\DB;
use Src\Currency\Domain\Interfaces\RateRepositoryInterface;

class DBRateRepository implements RateRepositoryInterface
{
    public function updateOrInsertRate(string $baseCurrency, string $targetCurrency, float $rate): void
    {
        DB::table('rates')->updateOrInsert(
            ['base_currency' => $baseCurrency, 'target_currency' => $targetCurrency],
            ['rate' => $rate, 'updated_at' => now()]
        );
    }
}
