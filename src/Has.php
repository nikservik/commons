<?php


namespace Nikservik\Commons;


use Illuminate\Support\Facades\Config;

class Has
{
    public static function feature(string $config, string $feature): bool
    {
        $features = Config::get("$config.features");

        if (! is_array($features)) {
            return false;
        }

        return in_array($feature, $features);
    }
}
