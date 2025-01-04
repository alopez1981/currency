<?php

namespace Src\Currency\Domain\Interfaces;

interface CurrencyRepositoryInterface
{
    public function getAll(): array;
}
