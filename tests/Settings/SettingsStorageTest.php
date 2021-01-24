<?php

namespace Tests\Commons\Settings;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Nikservik\Commons\Settings\SettingsStorage;
use Tests\TestCase;

class SettingsStorageTest extends TestCase
{
    public function testConstruct()
    {
        $settings = new SettingsStorage(['time' => 'old']);

        $this->assertEquals('old', $settings->get('time'));
    }

    public function testGetUnexistant()
    {
        $settings = new SettingsStorage(['time' => 'old']);

        $this->assertNull($settings->get('date'));
    }

    public function testSet()
    {
        $settings = new SettingsStorage;

        $settings->set('time', 'old');

        $this->assertEquals('old', $settings->get('time'));
    }

    public function testGetDeep()
    {
        $settings = new SettingsStorage(['ephemeris' => ['time' => 'old']]);

        $this->assertEquals('old', $settings->get('ephemeris.time'));
    }

    public function testSetDeep()
    {
        $settings = new SettingsStorage;

        $settings->set('ephemeris.time', 'old');

        $this->assertEquals('old', $settings->get('ephemeris.time'));
    }

    public function testGetDefaultConfig()
    {
        Config::set('jyotish.defaults.test.default', 'magic');
        $settings = new SettingsStorage;

        $this->assertEquals('magic', $settings->get('jyotish.test.default'));
    }

    public function testGetDefaultConfigEmpty()
    {
        Config::set('jyotish.defaults.test', 'magic');
        $settings = new SettingsStorage;

        $this->assertNull($settings->get('jyotish.empty'));
    }

    public function testToSave()
    {
        $settings = new SettingsStorage(['time' => 'old']);

        $this->assertEquals(1, count($settings->toSave()));
        $this->assertEquals('old', Arr::get($settings->toSave(), 'time'));
    }

    public function testLoad()
    {
        $array = (new SettingsStorage)->toSave();

        $this->assertInstanceOf(SettingsStorage::class, SettingsStorage::load($array));
    }

    public function testLoadAttribute()
    {
        $array = (new SettingsStorage(['time' => 'old']))->toSave();

        $this->assertEquals('old', SettingsStorage::load($array)->get('time'));
    }
}