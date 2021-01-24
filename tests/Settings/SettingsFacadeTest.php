<?php

namespace Tests\Commons\Settings;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Nikservik\Commons\Settings\Settings;
use Tests\TestCase;

class SettingsFacadeTest extends TestCase
{
    public function testGetDefaultConfig()
    {
        Config::set('jyotish.defaults.test.default', 'magic');

        $this->assertEquals('magic', Settings::get('jyotish.test.default'));
    }

    public function testGetDefaultConfigEmpty()
    {
        Config::set('jyotish.defaults.test', 'magic');

        $this->assertNull(Settings::get('jyotish.empty'));
    }
}