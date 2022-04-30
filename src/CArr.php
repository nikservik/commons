<?php

namespace Nikservik\Commons;

class CArr
{
    /**
     * Соединяет 2 массива рекурсивно
     * Совпадающие ключи перезаписывает значениями из второго массива
     * @param array $array1
     * @param array $array2
     * @return array
     */
    public static function merge(array $array1, array $array2): array
    {
        $merged = $array1;

        foreach ($array2 as $key => &$value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged [$key] = self::merge($merged[$key], $value);
            } else {
                $merged [$key] = $value;
            }
        }

        return $merged;
    }
}
