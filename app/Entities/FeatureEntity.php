<?php

namespace App\Entities;

use App\Core\Contracts\EnumInterface;
use App\Core\Entity;
use App\Core\VO\Identifier;
use App\Support\Manager\FeatureManager;

class FeatureEntity extends Entity implements EnumInterface
{
    private function __construct(
        private string $key,
        private ?Identifier $id = null
    ) {
        parent::__construct($id);
    }

    public static function create(
        string $key,
    ): static {
        return new static($key);
    }

    public static function restore(
        int $id,
        string $key,
    ): static {
        return new static($key, Identifier::create($id));
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getDescription(): string
    {
        return FeatureManager::fromValue($this->key)->withMeta()['description'];
    }
}
