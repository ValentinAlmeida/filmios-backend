<?php

namespace App\Eloquent\Services;

use App\Contracts\Services\QrCodeServiceInterface;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Support\Facades\Storage;

class QrCodeService implements QrCodeServiceInterface
{
    public function generateQrCode(string $link): string
    {
        $builder = new Builder();

        $result = $builder->build(data: $link);

        $fileName = 'qrcodes/' . uniqid() . '.png';
        Storage::disk('public')->put($fileName, $result->getString());

        return Storage::url($fileName);
    }
}
