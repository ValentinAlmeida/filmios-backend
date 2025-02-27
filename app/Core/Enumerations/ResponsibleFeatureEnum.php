<?php

namespace App\Core\Enumerations;

use App\Http\Controllers\ResponsibleController;
use Webfox\LaravelBackedEnums\IsBackedEnum;
use Webfox\LaravelBackedEnums\BackedEnum as BaseBackedEnum;

enum ResponsibleFeatureEnum: string implements BaseBackedEnum
{
    use IsBackedEnum;

    case SEARCH = 'feature.responsible.search';
    case UPDATE = 'feature.responsible.update';
    case FIND = 'feature.responsible.find';

    public function withMeta(): array
    {
        $common = [
            'classe' => ResponsibleController::class,
        ];

        return match ($this) {
            self::SEARCH => array_merge($common, [
                'description' => 'Procurar Responsável',
                'function' => ['search']
            ]),
            self::UPDATE => array_merge($common, [
                'description' => 'Atualizar Responsável',
                'function' => ['update', 'active']
            ]),
            self::FIND => array_merge($common, [
                'description' => 'Consultar Responsável',
                'function' => ['findById']
            ]),
        };
    }

    public static function isValid(string $value): bool
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return true;
            }
        }
        return false;
    }
}
