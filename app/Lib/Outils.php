<?php

namespace App\Lib;

final class Outils
{
    public static function generateStr(): string
    {
        $str = bin2hex(random_bytes(4));
        $stamp = time();

        $newStr = $str . $stamp;

        return  str_shuffle($newStr);
    }
}
