<?php

declare(strict_types=1);

namespace Src\Currency\Application\Handlers;

use Src\Currency\Application\Queries\GetCurrenciesQuery;
use Src\Currency\Domain\Interfaces\CurrencyRepositoryInterface;


class GetCurrenciesQueryHandler
{
    private CurrencyRepositoryInterface $repository;

    public function __construct(CurrencyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetCurrenciesQuery $query): array
    {
        return $this->repository->getAll();
    }
}
