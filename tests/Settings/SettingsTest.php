<?php

namespace Tests\Commons\Settings;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Nikservik\Commons\Settings\Settings;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    public function testConstruct()
    {
        $settings = new Settings(['time' => 'old']);

        $this->assertEquals('old', $settings->get('time'));
    }

    public function testGetUnexistant()
    {
        $settings = new Settings(['time' => 'old']);

        $this->assertNull($settings->get('date'));
    }

    public function testSet()
    {
        $settings = new Settings;

        $settings->set('time', 'old');

        $this->assertEquals('old', $settings->get('time'));
    }

    public function testGetDeep()
    {
        $settings = new Settings(['ephemeris' => ['time' => 'old']]);

        $this->assertEquals('old', $settings->get('ephemeris.time'));
    }

    public function testSetDeep()
    {
        $settings = new Settings;

        $settings->set('ephemeris.time', 'old');

        $this->assertEquals('old', $settings->get('ephemeris.time'));
    }

    public function testGetDefaultConfig()
    {
        Config::set('jyotish.defaults.test.default', 'magic');
        $settings = new Settings;

        $this->assertEquals('magic', $settings->get('jyotish.test.default'));
    }

    public function testGetDefaultConfigEmpty()
    {
        Config::set('jyotish.defaults.test', 'magic');
        $settings = new Settings;

        $this->assertNull($settings->get('jyotish.empty'));
    }

    public function testToSave()
    {
        $settings = new Settings(['time' => 'old']);

        $this->assertEquals(1, count($settings->toSave()));
        $this->assertEquals('old', Arr::get($settings->toSave(), 'time'));
    }

    public function testLoad()
    {
        $array = (new Settings)->toSave();

        $this->assertInstanceOf(Settings::class, Settings::load($array));
    }

    public function testLoadAttribute()
    {
        $array = (new Settings(['time' => 'old']))->toSave();

        $this->assertEquals('old', Settings::load($array)->get('time'));
    }
}