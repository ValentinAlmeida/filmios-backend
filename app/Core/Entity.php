<?php

namespace App\Core;

use App\Core\VO\Identifier;

abstract class Entity
{
    public function __construct(private ?Identifier $identifier)
    {}

    public function equals(Object $outro): bool
    {
        if (!($outro instanceof Entity)) {
            return false;
        }

        return $this->identifier->equals($outro->getIdentifier());
    }

    public function getIdentifier(): Identifier
    {
        return $this->identifier;
    }
}
