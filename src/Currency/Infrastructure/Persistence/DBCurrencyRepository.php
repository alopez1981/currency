<?php

declare (strict_types=1);

namespace Src\Currency\Infrastructure\Persistence;

use Src\Currency\Domain\Interfaces\CurrencyRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Src\Currency\Domain\ValueObjects\BaseCurrency;

class DBCurrencyRepository implements CurrencyRepositoryInterface
{
    public function getAll(): array
    {
        $currencies = DB::table("currencies")
            ->select('code')
            ->get();

        // Verificar el mapeo
        dd($currencies->map(fn($currency) => new BaseCurrency($currency->code))->toArray());

        return $currencies
            ->map(fn($currency) => new BaseCurrency($currency->code))
            ->toArray();
    }
}
