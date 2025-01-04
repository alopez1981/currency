<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Currency\Application\Commands\UpdateRatesCommand;
use Src\Currency\Application\Handlers\UpdateRatesCommandHandler;
use Src\Currency\Application\Services\UpdateRatesService;
use Src\Currency\Domain\ValueObjects\BaseCurrency;

class UpdateRatesCommandHandlerTest extends TestCase
{
    public function testUpdateRatesCommand(): void
    {
        $baseCurrency = new BaseCurrency('USD');

        $mockService = $this->createMock(UpdateRatesService::class);
        $mockService->expects($this->once())->method('__invoke')->with($baseCurrency);
        $handler = new UpdateRatesCommandHandler($mockService);
        $command = new UpdateRatesCommand($baseCurrency);

        $handler->__invoke($command);
    }
}
