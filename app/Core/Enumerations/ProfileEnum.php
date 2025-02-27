<?php

namespace App\Core\Enumerations;

use Webfox\LaravelBackedEnums\IsBackedEnum;
use Webfox\LaravelBackedEnums\BackedEnum as BaseBackedEnum;

enum ProfileEnum: string implements BaseBackedEnum
{
    use IsBackedEnum;

    case REGULADO = 'profile.regulado';
    case FISCAL = 'profile.fiscal';
    case GESTOR = 'profile.gestor';
    case ADMINISTRADOR = 'profile.administrador';

    public function withMeta(): array
    {
        return match ($this) {
            self::REGULADO => [
                'description' => 'Regulado',
            ],
            self::FISCAL => [
                'description' => 'Fiscal',
            ],
            self::GESTOR => [
                'description' => 'Gestor',
            ],
            self::ADMINISTRADOR => [
                'description' => 'Administrador',
            ],
        };
    }

    public function isNotRegulado(): bool
    {
        return $this !== self::REGULADO;
    }

    public function isNotFiscal(): bool
    {
        return $this !== self::FISCAL;
    }

    public function isNotFiscalOrRegulado(): bool
    {
        return $this !== self::FISCAL || $this !== self::REGULADO;
    }
}
