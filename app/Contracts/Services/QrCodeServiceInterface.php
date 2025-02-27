<?php

namespace App\Contracts\Services;

interface QrCodeServiceInterface
{
    public function generateQrCode(string $link): string;
}
