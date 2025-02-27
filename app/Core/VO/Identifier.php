<?php

namespace App\Core\VO;

class Identifier
{
    private string $identifier;

    public function __construct(string $value)
    {
        $this->identifier = $value;
    }

    public static function create(string $value): static
    {
        return new static($value);
    }

    public function getValue(): string
    {
        return $this->identifier;
    }

    public function toString(): string
    {
        return $this->getValue();
    }

    public function isEmpty(): bool
    {
        return strlen($this->getValue()) == 0;
    }


    public function equals(Object $outro): bool
    {
        if (!($outro instanceof static)) {
            return false;
        }

        if ($this->isEmpty()) {
            return false;
        }

        return strcmp($this->getValue(), $outro->getValue()) == 0;
    }
}
