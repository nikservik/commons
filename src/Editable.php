<?php

namespace Nikservik\Commons;

class Editable
{
    /**
     * Форматирует текст для активного редактирования, подходит для обновляемого текста
     * @param string $content
     * @return string
     */
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

    /**
     * Форматирует текст после редактирования. Не подходит для активного
     * редактирования, потому что обрезает пустые строки в конце.
     * @param string $content
     * @return string
     */
    public static function formatFinal(string $content): string
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
        // убираем завершающие пустые р
        $content = self::trimLastEmptyPs($content);
        // заменяем повторяющиеся пустые р на один
        $content = self::replaceMultipleP($content);

        return $content;
    }

    /**
     * Удаляет все лишние теги, осьтавляет только p, br, b, i, u
     * @param string $content
     * @return string
     */
    public static function stripTags(string $content): string
    {
        return strip_tags($content, ['div', 'p', 'br', 'b', 'i', 'u']);
    }

    /**
     * Удаляет все атрибуты тегов
     * @param string $content
     * @return string
     */
    public static function stripTagAttributes(string $content): string
    {
        return preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/si",'<$1$2>', $content);
    }

    /**
     * Заменяет div на р
     * @param string $content
     * @return string
     */
    public static function replaceDivByP(string $content): string
    {
        return str_replace(['<div>', '</div>'], ['<p>', '</p>'], $content);
    }

    /**
     * Обрезает пустые символы вокруг текста и удаляет ведущий пустой р
     * @param string $content
     * @return string
     */
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

    /**
     * Удаляет пустые р в конце текста
     * @param string $content
     * @return string
     */
    public static function trimLastEmptyPs(string $content): string
    {
        // обрезаем пустые символы
        $content = trim($content);
        // обрезаем пустые р в конце текста
        while (substr($content, -7) == '<p></p>') {
            $content = trim(substr($content, 0, -7));
        }
        // обрезаем пустые р c br в конце текста
        while (substr($content, -11) == '<p><br></p>') {
            $content = trim(substr($content, 0, -11));
        }

        return $content;
    }

    /**
     * Заменяет повторяющиеся пустые р на один
     * @param string $content
     * @return string
     */
    public static function replaceMultipleP(string $content): string
    {
        // обрезаем пустые символы
        $content = preg_replace("/(<p><br><\/p>)+/", "<p><br></p>", $content);
        $content = preg_replace("/(<p><\/p>)+/", "<p></p>", $content);

        return $content;
    }

    /**
     * Оборачивает текст в р, если его нет
     * @param string $content
     * @return string
     */
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
