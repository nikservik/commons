<?php

namespace Nikservik\Commons\Tests;

use Nikservik\Commons\CommonsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            CommonsServiceProvider::class,
        ];
    }
}
