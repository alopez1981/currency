<?php

declare(strict_types=1);

namespace Src\Currency\Domain\Entities;

use Src\Currency\Domain\ValueObjects\BaseCurrency;

class Currency
{
    private BaseCurrency $baseCurrency;
    private string $name;

    public function __construct(BaseCurrency $baseCurrency, string $name)
    {
        $this->baseCurrency = $baseCurrency;
        $this->name = $name;
    }

    public function getCode(): BaseCurrency
    {
        return $this->baseCurrency;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
