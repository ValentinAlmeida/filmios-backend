<?php

namespace App\Core\DTO;

class ResetPasswordDTO
{
    public function __construct(
        public readonly string $password,
    ) {}
}
