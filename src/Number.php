<?php

namespace Nikservik\Commons;

class Number
{
    protected static array $ends = ['th','st','nd','rd','th','th','th','th','th','th'];

    public static function ordinal(int $number): string
    {
        if ($number % 100 >= 11 && $number % 100 <= 13)
            return $number. self::$ends[0];
        else
            return $number. self::$ends[$number % 10];
    }

    public static function pluralRu(int $number, array $forms): string
    {
        if (count($forms) < 3)
            return ''.$number;

        if ($number % 10 == 1 && $number % 100 != 11)
            return $number . ' ' . $forms[0];

        if ($number % 10 >= 2 && $number % 10 <= 4 && ($number % 100 < 10 || $number % 100 >= 20))
            return $number . ' ' . $forms[1];

        return $number . ' ' . $forms[2];
    }

    public static function between(float $limitA, float $number, float $limitB): bool
    {
        return ($limitA <= $limitB && $number >= $limitA && $number <= $limitB)
            || ($limitB <= $limitA && $number >= $limitB && $number <= $limitA);
    }
}
