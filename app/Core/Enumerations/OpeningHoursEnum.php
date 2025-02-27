<?php

namespace App\Core\Enumerations;

use Webfox\LaravelBackedEnums\IsBackedEnum;
use Webfox\LaravelBackedEnums\BackedEnum as BaseBackedEnum;

enum OpeningHoursEnum: string implements BaseBackedEnum
{
    use IsBackedEnum;

    case MONDAY = 'opening.hours.monday';
    case TUESDAY = 'opening.hours.tuesday';
    case WEDNESDAY = 'opening.hours.wednesday';
    case THURSDAY = 'opening.hours.thursday';
    case FRIDAY = 'opening.hours.friday';
    case SATURDAY = 'opening.hours.saturday';
    case SUNDAY = 'opening.hours.sunday';

    public function withMeta(): array
    {
        return match ($this) {
            self::MONDAY => [
                'description' => 'Segunda-feira',
            ],
            self::TUESDAY => [
                'description' => 'Terça-feira',
            ],
            self::WEDNESDAY => [
                'description' => 'Quarta-feira',
            ],
            self::THURSDAY => [
                'description' => 'Quinta-feira',
            ],
            self::FRIDAY => [
                'description' => 'Sexta-feira',
            ],
            self::SATURDAY => [
                'description' => 'Sabado',
            ],
            self::SUNDAY => [
                'description' => 'Domingo',
            ],
        };
    }
}
