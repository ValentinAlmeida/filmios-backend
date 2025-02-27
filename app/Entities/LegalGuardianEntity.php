<?php

namespace App\Entities;

use App\Core\DTO\CreateLegalGuardianDTO;
use App\Core\DTO\RestoreLegalGuardianDTO;
use App\Core\Entity;
use App\Core\Property\LegalGuardianProperty;
use App\Core\VO\Identifier;

class LegalGuardianEntity extends Entity
{
    private function __construct(
        private LegalGuardianProperty $props,
        private ?Identifier $identifier = null,
    ) {
        parent::__construct( $identifier);
    }

    public static function create(
        CreateLegalGuardianDTO $createLegalGuardianDTO
    ): static {
        $props = new LegalGuardianProperty($createLegalGuardianDTO->name, $createLegalGuardianDTO->cpf);
        return new static($props);
    }

    public static function restore(
        RestoreLegalGuardianDTO $restoreLegalGuardianDTO,
        int $id
    ): static {
        $props = new LegalGuardianProperty($restoreLegalGuardianDTO->name, $restoreLegalGuardianDTO->cpf, $restoreLegalGuardianDTO->created_at);
        return new static($props, Identifier::create($id));
    }

    public function getName(): ?string
    {
        return $this->props->name;
    }

    public function getCpf(): string
    {
        return $this->props->cpf;
    }
}
