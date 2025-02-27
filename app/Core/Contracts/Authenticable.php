<?php

namespace App\Core\Contracts;

interface Authenticable
{
    public function getLogin(): ?string;

    public function isActive(): bool;

    public function getEmail(): ?string;

    public function isBlocked(): bool;
}
