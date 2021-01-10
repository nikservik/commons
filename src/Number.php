<?php

namespace Nikservik\Commons;

use Illuminate\Support\Str;

class Number
{
    protected static $ends = ['th','st','nd','rd','th','th','th','th','th','th'];

    public static function ordinal(int $number): string 
    {
        if ($number % 100 >= 11 && $number % 100 <= 13)
            return $number. self::$ends[0];
        else
            return $number. self::$ends[$number % 10];
    }

    public static function between(float $limitA, float $number, float $limitB): bool
    {
        return ($limitA <= $limitB && $number >= $limitA && $number <= $limitB)
            || ($limitB <= $limitA && $number >= $limitB && $number <= $limitA);
    }
}