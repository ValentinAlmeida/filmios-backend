<?php

namespace App\Core\Enumerations;

use App\Http\Controllers\UserController;
use Webfox\LaravelBackedEnums\IsBackedEnum;
use Webfox\LaravelBackedEnums\BackedEnum as BaseBackedEnum;

enum UserFeatureEnum: string implements BaseBackedEnum
{
    use IsBackedEnum;

    case SEARCH = 'feature.user.search';
    case CREATE = 'feature.user.create';
    case DELETE = 'feature.user.delete';
    case UPDATE = 'feature.user.update';
    case FIND = 'feature.user.find';

    public function withMeta(): array
    {
        $common = [
            'classe' => UserController::class,
        ];

        return match ($this) {
            self::SEARCH => array_merge($common, [
                'description' => 'Procurar Usuário',
                'function' => ['search']
            ]),
            self::CREATE => array_merge($common, [
                'description' => 'Criar Usuário',
                'function' => ['create']
            ]),
            self::DELETE => array_merge($common, [
                'description' => 'Deletar Usuário',
                'function' => ['delete']
            ]),
            self::UPDATE => array_merge($common, [
                'description' => 'Atualizar Usuário',
                'function' => ['update', 'unblockAccess', 'modifyState']
            ]),
            self::FIND => array_merge($common, [
                'description' => 'Consultar Usuário',
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
