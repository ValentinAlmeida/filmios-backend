<?php

namespace App\Core\DTO;

class RecoveryPasswordDTO
{
    public function __construct(
        public readonly string $email,
        public readonly ?string $url = null,
    ) {}
}
