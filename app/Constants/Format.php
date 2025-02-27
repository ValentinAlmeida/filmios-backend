<?php

namespace App\Constants;

use DateTimeInterface;

abstract class Format
{
    public const DATE_TIME = DateTimeInterface::ATOM;
    public const DATE = 'd/m/Y';
    public const SCHEDULE = 'H:i:s';
}
