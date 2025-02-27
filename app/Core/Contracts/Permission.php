<?php

namespace App\Core\Contracts;

use App\Core\Negocios\Funcionalidade;
use App\Core\Negocios\PapelUsuario;

interface Permission
{
    public function getFuncionalidade(): Funcionalidade;

    public function getPapel(): PapelUsuario;

    public function equals(Object $outro): bool;

    public function toString(): string;
}
