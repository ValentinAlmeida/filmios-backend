<?php

namespace App\Core\Exceptions\Contracts;

interface Enumeration
{
    public function mensagem(): string;

    public function codigo(): string;
}
