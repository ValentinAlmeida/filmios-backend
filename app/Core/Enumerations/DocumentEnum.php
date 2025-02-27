<?php

namespace App\Core\Enumerations;

use Webfox\LaravelBackedEnums\IsBackedEnum;
use Webfox\LaravelBackedEnums\BackedEnum as BaseBackedEnum;

enum DocumentEnum: string implements BaseBackedEnum
{
    use IsBackedEnum;

    case CPF = 'document.cpf';
    case CNPJ = 'document.cnpj';

    public function withMeta(): array
    {
        return match ($this) {
            self::CPF => [
                'description' => 'CPF',
            ],
            self::CNPJ => [
                'description' => 'CNPJ',
            ],
        };
    }
}
