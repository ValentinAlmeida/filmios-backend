<?php

use Carbon\Carbon;

if (!function_exists('value_or_null')) {
    function value_or_null($value)
    {
        return empty($value) ? null : $value;
    }
}

if (!function_exists('bool_or_null')) {
    function bool_or_null($value)
    {
        return is_bool($value) ? $value : (in_array(strtolower($value), ['true', 'false', '1', '0'], true) ? filter_var($value, FILTER_VALIDATE_BOOLEAN) : null);
    }
}

if (!function_exists('enum_or_null')) {
    function enum_or_null(string $enumClass, $value)
    {
        try {
            return $enumClass::from($value);
        } catch (\ValueError $e) {
            return null;
        }
    }
}

if (!function_exists('carbon_or_null')) {
    function carbon_or_null(?string $format, $value)
    {
        if(!empty($value)){
            !empty($format) ? $carbon = Carbon::createFromFormat($format, $value) : $carbon = Carbon::create($value);

            return $carbon;
        }

        return null;
    }
}

if (!function_exists('map_or_null')) {
    function map_or_null(string $mapperClass, $model)
    {
        try {
            return method_exists($mapperClass, 'parseModelToEntity') ? $mapperClass::parseModelToEntity($model) : null;
        } catch (\Exception $e) {
            return null;
        }
    }
}

if (!function_exists('like')) {
    function like(string $str)
    {
        return "%{$str}%";
    }
}
