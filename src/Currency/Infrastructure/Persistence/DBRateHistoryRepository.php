<?php

declare (strict_types=1);

namespace Src\Currency\Infrastructure\Persistence;

use Src\Currency\Domain\Entities\RateHistory;
use Src\Currency\Domain\Interfaces\RateHistoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DBRateHistoryRepository implements RateHistoryRepositoryInterface
{
    public function save(RateHistory $rateHistory): void
    {
        DB::table('rate_history')->insert([
           'base_currency' => $rateHistory->getBaseCurrency(),
           'target_currency' => $rateHistory->getTargetCurrency(),
           'rate' => $rateHistory->getRate(),
           'date' => $rateHistory->getDate()->format('Y-m-d H:i:s'),
        ]);
    }

    public function findByDate(\DateTimeImmutable $date) : array
    {
        return DB::table('rate_history')
            ->where('date', $date->format('Y-m-d'))
            ->get()
            ->toArray();
    }
}
