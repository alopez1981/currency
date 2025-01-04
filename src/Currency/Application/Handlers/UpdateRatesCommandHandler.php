<?php

declare(strict_types=1);

namespace Src\Currency\Application\Handlers;


use Src\Currency\Application\Commands\UpdateRatesCommand;
use Src\Currency\Application\Services\UpdateRatesService;

class UpdateRatesCommandHandler
{
    private UpdateRatesService $updateRatesService;

    public function __construct(UpdateRatesService $updateRatesService)
    {
        $this->updateRatesService = $updateRatesService;
    }

    public function __invoke(UpdateRatesCommand $command): void
    {
        $this->updateRatesService->__invoke($command->getBaseCurrency());
    }

}
