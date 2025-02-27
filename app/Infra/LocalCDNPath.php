<?php

namespace App\Infra;

final class LocalCDNPath extends CDNPath
{
    protected function __construct()
    {
        parent::__construct(str(config('app.url'))->append('/', 'archive')->value());
    }
}
