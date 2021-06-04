<?php

namespace Nikservik\Commons\Tests\Translatable;

use Illuminate\Support\Facades\Config;
use Nikservik\Commons\Tests\TestCase;
use Nikservik\Commons\Translatable\Translatable;

class TranslatableTest extends TestCase
{
    public function test_get_translation()
    {
        $translatable = new Translatable(['ru' => 'test']);

        $this->assertEquals('test', $translatable->getTranslation('ru'));
    }

    public function test_get_translation_via_magic()
    {
        $translatable = new Translatable(['ru' => 'test']);

        $this->assertEquals('test', $translatable->ru);
    }

    public function test_construct_with_string()
    {
        Config::set('app.locale', 'ru');
        $translatable = new Translatable('test');

        $this->assertEquals('test', $translatable->getTranslation('ru'));
    }

    public function test_get_translation_on_unexistant_locale()
    {
        $translatable = new Translatable(['ru' => 'test']);

        $this->assertEquals('test', $translatable->getTranslation('en'));
    }

    public function test_get_translation_on_unexistant_locale_returns_current()
    {
        Config::set('app.locale', 'ru');
        $translatable = new Translatable(['en' => 'test-en', 'ru' => 'test']);

        $this->assertEquals('test', $translatable->getTranslation('de'));
    }

    public function test_set_translation()
    {
        $translatable = new Translatable([]);

        $translatable->setTranslation('ru', 'test');

        $this->assertEquals('test', $translatable->getTranslation('ru'));
    }

    public function test_set_translation_via_magic()
    {
        $translatable = new Translatable([]);

        $translatable->ru = 'test';

        $this->assertEquals('test', $translatable->getTranslation('ru'));
    }

    public function test_to_string_magic()
    {
        $translatable = new Translatable('test');

        $this->assertEquals('test', (string) $translatable);
    }

    public function test_to_array()
    {
        $translatable = new Translatable(['en' => 'test-en', 'ru' => 'test']);

        $this->assertEquals(['en' => 'test-en', 'ru' => 'test'], $translatable->toArray());
    }
}
