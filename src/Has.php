<?php


namespace Nikservik\Commons;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class Has
{
    public static function feature(string $config, string $feature = null): bool
    {
        if ($feature === null) {
            if (! Str::contains($config, '.')) {
                return false;
            }

            $feature = Str::after($config, '.');
            $config = Str::before($config, '.');
        }

        $features = Config::get("$config.features");

        if (! is_array($features)) {
            return false;
        }

        return in_array($feature, $features);
    }
}
