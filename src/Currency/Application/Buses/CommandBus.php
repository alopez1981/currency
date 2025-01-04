<?php

declare (strict_types=1);

namespace Src\Currency\Application\Buses;

use Symfony\Component\Console\Exception\CommandNotFoundException;

class CommandBus
{
    private array $handlers = [];

    public function register(string $commandClass, callable $handler): void
    {
        $this->handlers[$commandClass] = $handler;
    }

    public function dispatch(object $command): void
    {
        $commandClass = get_class($command);

        if (!isset($this->handlers[$commandClass])) {
            throw new \RuntimeException("No handler for command '$commandClass'");
        }

        ($this->handlers[$commandClass])($command);
    }
}
