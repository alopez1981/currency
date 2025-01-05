<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Src\Currency\Application\Buses\CommandBus;
use Src\Currency\Application\Commands\UpdateRatesCommand;
use Src\Currency\Domain\ValueObjects\BaseCurrency;

class ScheludeUpdateRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rates:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency rates and save them in the database';

    private CommandBus $commandBus;

    public function __construct(CommandBus  $commandBus)
    {
        parent::__construct();
        $this->commandBus = $commandBus;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $command = new UpdateRatesCommand(new BaseCurrency('USD'));

        $this->commandBus->dispatch($command);

        $this->info('Currency rates updated successfully!');
    }
}
