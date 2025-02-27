<?php

namespace App\Core\Enumerations;

use App\Http\Controllers\RequestController;
use Webfox\LaravelBackedEnums\IsBackedEnum;
use Webfox\LaravelBackedEnums\BackedEnum as BaseBackedEnum;

enum RequestFeatureEnum: string implements BaseBackedEnum
{
    use IsBackedEnum;

    case SEARCH = 'feature.request.search';
    case UPDATE = 'feature.request.update';
    case FIND = 'feature.request.find';

    public function withMeta(): array
    {
        $common = [
            'classe' => RequestController::class,
        ];

        return match ($this) {
            self::SEARCH => array_merge($common, [
                'description' => 'Procurar Solicitação',
                'function' => ['search', 'searchHistory']
            ]),
            self::UPDATE => array_merge($common, [
                'description' => 'Atualizar Solicitação',
                'function' => ['update']
            ]),
            self::FIND => array_merge($common, [
                'description' => 'Consultar Solicitação',
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
