<?php

namespace App\Entities;

use App\Core\Contracts\DomainInterface;
use App\Core\Entity;
use App\Core\VO\Identifier;

class DomainEntity extends Entity implements DomainInterface
{
    private function __construct(
        private Identifier $id,
        private string $description,
    ) {
        parent::__construct($id);
    }

    public static function create(
        int $id,
        string $description,
    ): static {
        return new static(Identifier::create($id), $description);
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
