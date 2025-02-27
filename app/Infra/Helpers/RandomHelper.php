<?php

namespace App\Infra\Helpers;

class RandomHelper
{
    public static function getProtocol(): string
    {
        return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }
    public static function getNewPassword(): string
    {
        $uppercase = chr(mt_rand(65, 90));
        $lowercase = chr(mt_rand(97, 122));
        $number = chr(mt_rand(48, 57));
        $special = chr(mt_rand(33, 47));
        $remaining = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()'), 0, 4);

        return str_shuffle("{$uppercase}{$lowercase}{$number}{$special}{$remaining}");
    }

    public static function getRand(): int
    {
        return rand(1, 1000000000);
    }
}
