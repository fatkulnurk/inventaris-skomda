<?php

namespace App\Services\Qr;

use chillerlan\QRCode\QRCode;

class QrService
{
    public function generateFromString(string $data): string
    {
        return (new QRCode)->render($data);
    }
}
