<?php

namespace App;

use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode as EndroidQrCode;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class QrCode
{
    private const CONSULTA_URL = 'https://www.nfse.gov.br/ConsultaPublica';

    public static function url(string $chave): string
    {
        return self::CONSULTA_URL.'?tpc=1&chave='.urlencode($chave);
    }

    public static function image(string $chave, int $size = 180): string
    {
        $qr = new EndroidQrCode(
            data: self::url($chave),
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Medium,
            size: $size,
            margin: 4,
            roundBlockSizeMode: RoundBlockSizeMode::Margin
        );

        $writer = new PngWriter();

        $result = $writer->write($qr);

        return 'data:image/png;base64,'.base64_encode($result->getString());
    }
}