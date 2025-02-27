<?php

namespace App\Core\Contracts;

interface EnumInterface
{
    public function getKey(): string;
    public function getDescription(): string;
}
