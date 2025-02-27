<?php

namespace App\Core;

interface Comparable
{
    public function equals($other): bool;
}
