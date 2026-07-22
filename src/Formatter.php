<?php

namespace App;

class Formatter
{
    public static function data(?string $valor): string
    {
        return $valor ?: '-';
    }

    public static function moeda(?string $valor): string
    {
        return $valor ?: '-';
    }

    public static function documento(?string $valor): string
    {
        return $valor ?: '-';
    }
}