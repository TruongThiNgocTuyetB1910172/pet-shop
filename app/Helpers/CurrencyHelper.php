<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function format($amount): string
    {
        return number_format($amount, 0, ',', '.') . ' vn₫';
    }
}
