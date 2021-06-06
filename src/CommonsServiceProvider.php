<?php


namespace Nikservik\Commons;


use Illuminate\Support\ServiceProvider;

class CommonsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'commons');

        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../views' => resource_path('views/vendor/commons'),
        ], 'commons-views');
    }

}
