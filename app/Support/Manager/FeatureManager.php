<?php

namespace App\Support\Manager;

use App\Core\Enumerations\EstablishmentFeatureEnum;
use App\Core\Enumerations\RequestFeatureEnum;
use App\Core\Enumerations\ResponsibleFeatureEnum;
use App\Core\Enumerations\UserFeatureEnum;
use App\Entities\FeatureEntity;

class FeatureManager
{
    private static array $registeredEnums = [
        UserFeatureEnum::class,
        ResponsibleFeatureEnum::class,
        RequestFeatureEnum::class,
        EstablishmentFeatureEnum::class,
    ];

    public static function isValidFeature(string $feature): bool
    {
        foreach (self::$registeredEnums as $enumClass) {
            if ($enumClass::isValid($feature)) {
                return true;
            }
        }

        return false;
    }

    public static function fromValue(string $feature)
    {
        foreach (self::$registeredEnums as $enumClass) {
            if ($enumClass::isValid($feature)) {
                return $enumClass::from($feature);
            }
        }

        throw new \InvalidArgumentException("Feature $feature is not valid.");
    }

    public static function fromArray(array $features): array
    {
        return array_map(fn (FeatureEntity $feature) => self::fromValue($feature->getKey()), $features);
    }

    public static function rule()
    {
        foreach (self::$registeredEnums as $enumClass) {
            return $enumClass::rule();
        }
    }
}
