<?php

namespace Tests\Commons\Settings;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Nikservik\Commons\Settings\SettingsManager;
use Tests\TestCase;

class SettingsManagerTest extends TestCase
{
    public function testGetDefaultConfig()
    {
        Config::set('jyotish.defaults.test.default', 'magic');
        $settings = new SettingsManager;

        $this->assertEquals('magic', $settings->get('jyotish.test.default'));
    }

    public function testGetDefaultConfigEmpty()
    {
        Config::set('jyotish.defaults.test', 'magic');
        $settings = new SettingsManager;

        $this->assertNull($settings->get('jyotish.empty'));
    }
}