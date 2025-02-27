<?php

namespace App\Core\Enumerations;

use Webfox\LaravelBackedEnums\IsBackedEnum;
use Webfox\LaravelBackedEnums\BackedEnum as BaseBackedEnum;

enum TypeServicesEnum: string implements BaseBackedEnum
{
    use IsBackedEnum;

    case DISPENSA = 'type.service.dispensa';

    public function withMeta(): array
    {
        return match ($this) {
            self::DISPENSA => [
                'description' => 'Declaração de Dispensa de Ato Público',
            ],
        };
    }
}
