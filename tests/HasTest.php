<?php

namespace Nikservik\Commons\Tests;

use Illuminate\Support\Facades\Config;
use Nikservik\Commons\Has;

class HasTest extends TestCase
{

    public function test_has_feature_without_config()
    {
        $this->assertFalse(Has::feature("no_config", "no_feature"));
    }

    public function test_has_feature_without_features_array()
    {
        Config::set('test', ['some_parameter' => 'some_value']);

        $this->assertFalse(Has::feature("test", "feature"));
    }

    public function test_has_feature_when_features_not_array()
    {
        Config::set('test', ['features' => 'some_value']);

        $this->assertFalse(Has::feature("test", "feature"));
    }

    public function test_has_feature_when_feature_not_in_array()
    {
        Config::set('test.features', ['some_feature']);

        $this->assertFalse(Has::feature("test", "feature"));
    }

    public function test_has_feature_when_feature_in_array()
    {
        Config::set('test.features', ['some_feature', 'feature']);

        $this->assertTrue(Has::feature("test", "feature"));
    }
}
