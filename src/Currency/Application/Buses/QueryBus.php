<?php

declare(strict_types=1);

namespace Src\Currency\Application\Buses;

use RuntimeException;

class QueryBus
{
    private array $handlers = [];

    public function register(string $queryClass, callable $handler): void
    {
        $this->handlers[$queryClass] = $handler;
    }

    public function dispatch(object $query)
    {
        $queryClass = get_class($query);

        if(!isset($this->handlers[$queryClass])) {
            throw new RuntimeException("No handler found for $queryClass");
        }

        return ($this->handlers[$queryClass])($query);
    }
}
