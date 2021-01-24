<?php

namespace Nikservik\Commons;

use Illuminate\Support\ServiceProvider;
use Nikservik\Commons\Settings\SettingsManager;

class CommonsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('commons.settings', function() {
            return new SettingsManager;
        });
    }
}
