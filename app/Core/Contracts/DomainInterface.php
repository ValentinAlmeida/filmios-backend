<?php

namespace App\Core\Contracts;

use App\Core\VO\Identifier;

interface DomainInterface
{
    public function getDescription(): string;
    public function getIdentifier(): Identifier;
}
