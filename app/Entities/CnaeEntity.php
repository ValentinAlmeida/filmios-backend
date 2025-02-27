<?php

namespace App\Entities;

use App\Core\Entity;
use App\Core\VO\Identifier;

class CnaeEntity extends Entity
{
    private function __construct(
        private Identifier $identifier,
        private string $code,
        private ?string $description,
    ) {
        parent::__construct( $identifier);
    }

    public static function create(
        int $id,
        string $code,
        ?string $description,
    ): static {
        return new static(Identifier::create($id), $code, $description);
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAllName(): string
    {
        return $this->code . ' - ' . $this->description;
    }
}
