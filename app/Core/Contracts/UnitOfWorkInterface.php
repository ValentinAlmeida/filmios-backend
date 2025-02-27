<?php

namespace App\Core\Contracts;

use Closure;

interface UnitOfWorkInterface
{
    public function run(Closure $cb): mixed;
}
