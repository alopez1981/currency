<?php

declare (strict_types=1);

namespace Src\Currency\Application\Commands;

use Src\Currency\Domain\ValueObjects\BaseCurrency;

class UpdateRatesCommand
{
    private BaseCurrency $baseCurrency;

    public function __construct(BaseCurrency $baseCurrency)
    {
        $this->baseCurrency = $baseCurrency;
    }

    public function getBaseCurrency(): BaseCurrency
    {
        return $this->baseCurrency;
    }
}

