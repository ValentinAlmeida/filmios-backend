<?php

namespace App\Entities;

use App\Core\Contracts\EnumInterface;
use App\Core\Entity;
use App\Core\Enumerations\ProfileEnum;
use App\Core\VO\Identifier;

class ProfileEntity extends Entity implements EnumInterface
{
    private function __construct(
        private Identifier $identifier,
        private string $key,
        private ?array $feature,
    ) {
        parent::__construct( $identifier);
    }

    public static function create(
        int $id,
        string $key,
        ?array $feature,
    ): static {
        return new static(Identifier::create($id), $key, $feature);
    }

    public function getFeature(): ?array
    {
        return $this->feature;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getProfileEnum(): ProfileEnum
    {
        return ProfileEnum::from($this->key);
    }

    public function getDescription(): string
    {
        return ProfileEnum::from($this->getKey())->withMeta()['description'];
    }
}
