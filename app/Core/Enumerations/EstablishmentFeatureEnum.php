<?php

namespace App\Core\Enumerations;

use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\ResponsibleController;
use Webfox\LaravelBackedEnums\IsBackedEnum;
use Webfox\LaravelBackedEnums\BackedEnum as BaseBackedEnum;

enum EstablishmentFeatureEnum: string implements BaseBackedEnum
{
    use IsBackedEnum;

    case SEARCH = 'feature.establishment.search';
    case UPDATE = 'feature.establishment.update';
    case FIND = 'feature.establishment.find';

    public function withMeta(): array
    {
        $common = [
            'classe' => EstablishmentController::class,
        ];

        return match ($this) {
            self::SEARCH => array_merge($common, [
                'description' => 'Procurar Estabelecimento',
                'function' => ['search']
            ]),
            self::UPDATE => array_merge($common, [
                'description' => 'Atualizar Estabelecimento',
                'function' => ['update', 'active']
            ]),
            self::FIND => array_merge($common, [
                'description' => 'Consultar Estabelecimento',
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
