<?php

declare (strict_types=1);

namespace Src\Currency\Domain\ValueObjects;

class BaseCurrency
{
    private string $code;

    public function __construct(string $code)
    {
        if (!$this->isValid($code)) {
            throw new \InvalidArgumentException("Invalid currency code");
        }
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function isValid(string $code): bool
    {
        return preg_match('/^[A-Z]{3}$/', $code) === 1;
    }

}
