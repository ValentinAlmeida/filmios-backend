<?php

namespace App\Core\DTO;

class SyncFeaturesDTO
{
    public function __construct(
        public readonly array $features,
        public readonly string $profile_key,
    ) {}
}
