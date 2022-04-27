<?php

namespace Nikservik\Commons;

class Editable
{
    public static function format(string $content): string
    {
        // убираем все лишние теги
        $content = self::stripTags($content);
        // убираем все атрибуты тегов
        $content = self::stripTagAttributes($content);
        // заменяем div на p
        $content = self::replaceDivByP($content);
        // обрезаем пустые символы
        $content = self::trim($content);
        // оборачиваем в р, если его нет
        $content = self::envelopeWithP($content);

        return $content;
    }

    public static function stripTags(string $content): string
    {
        return strip_tags($content, ['div', 'p', 'br', 'b', 'i', 'u']);
    }

    public static function stripTagAttributes(string $content): string
    {
        return preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/si",'<$1$2>', $content);
    }

    public static function replaceDivByP(string $content): string
    {
        return str_replace(['<div>', '</div>'], ['<p>', '</p>'], $content);
    }

    public static function trim(string $content): string
    {
        // обрезаем пустые символы
        $content = trim($content);
        // обрезаем пустой р в начале текста
        if (substr($content, 0, 7) == '<p></p>') {
            $content = substr($content, 7);
        }

        return $content;
    }

    public static function envelopeWithP(string $content): string
    {
        // если текст начинается с р, то ничего не делаем
        if (substr($content, 0, 3) == '<p>') {
            return $content;
        }

        // вычисляем начало первого р
        $pEnds = strpos($content, '<p>');

        // если р вообще нет, то заворачиваем в р весь текст
        if ($pEnds === false) {
            return '<p>' . $content . '</p>';
        }

        // находим незавернутый текст и завернутый
        $pContent= substr($content, 0, $pEnds);
        $rest = substr($content, $pEnds);

        // незавернутый заворачиваем, остальное добавляем как есть
        return '<p>' . $pContent . '</p>' . $rest;
    }

}
