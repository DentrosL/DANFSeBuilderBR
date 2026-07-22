<?php

namespace App;

class QrCode
{
    public static function url(string $chave): string
    {
        return sprintf(
            'https://www.nfse.gov.br/ConsultaPublica/?tpc=1&chave=%s',
            $chave
        );
    }
}