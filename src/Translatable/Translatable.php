<?php


namespace Nikservik\Commons\Translatable;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Config;

class Translatable implements Arrayable
{
    protected array $translations = [];
    protected $currentLocale;

    public static function loadFromLocales(string $name): Translatable
    {
        $translations = [];
        foreach (Config::get('app.locales') as $locale) {
            $translations[$locale] = trans($name, [], $locale);
        }
        return new Translatable($translations);
    }

    public function __construct($translations)
    {
        $this->currentLocale = Config::get('app.locale');

        if (is_array($translations)) {
            $this->translations = $translations;
        } else {
            $this->translations[$this->currentLocale] = $translations;
        }
    }

    public function __toString()
    {
        return $this->getTranslation($this->currentLocale);
    }

    public function __get($locale)
    {
        return $this->getTranslation($locale);
    }

    public function __set($locale, $value)
    {
        $this->setTranslation($locale, $value);
    }

    public function __serialize()
    {
        return $this->toArray();
    }

    public function getTranslation($locale): string
    {
        if (!count($this->translations)) {
            return '';
        }

        if (array_key_exists($locale, $this->translations)) {
            return $this->translations[$locale];
        } elseif (array_key_exists($this->currentLocale, $this->translations)) {
            return $this->translations[$this->currentLocale];
        } else {
            return $this->translations[array_keys($this->translations)[0]];
        }
    }

    public function setTranslation($locale, $value): void
    {
        if (! $locale) {
            return;
        }

        if ($value) {
            $this->translations[$locale] = $value;
        } else {
            unset($this->translations[$locale]);
        }
    }

    public function toArray(): array
    {
        return $this->translations;
    }
}
