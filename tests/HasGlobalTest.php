<?php


namespace Nikservik\Commons\Tests;


use Illuminate\Support\Facades\Config;

class HasGlobalTest extends TestCase
{

    public function test_has_feature_without_use()
    {
        Config::set('test.features', ['some_feature', 'feature']);

        $this->assertTrue(Has::feature("test", "feature"));
    }

}
