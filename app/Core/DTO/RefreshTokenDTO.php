<?php

namespace App\Core\DTO;

class RefreshTokenDTO
{
    public function __construct(
        public readonly string $refresh_token,
    ) {}
}
