<?php

declare (strict_types=1);

namespace Src\Currency\Domain\Interfaces;

use Src\Currency\Domain\Entities\RateHistory;

interface RateHistoryRepositoryInterface
{
    public function save(RateHistory $rateHistory): void;
    public function findByDate(\DateTimeImmutable $date): array;
}
