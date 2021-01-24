<?php

namespace Nikservik\Commons\Settings;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Nikservik\Commons\Interfaces\SaveLoadInterface;

class SettingsStorage implements SaveLoadInterface
{
    protected $settings;

    public function __construct(array $settings = [])
    {
        $this->settings = $settings;
    }

    public function get(string $name)
    {
        return Arr::get($this->settings, $name, Config::get(Str::replaceFirst('.', '.defaults.', $name), null));
    }

    public function set(string $name, $value): SettingsStorage
    {
        Arr::set($this->settings, $name, $value);

        return $this;
    }

    public function toSave(): array
    {
        return $this->settings;
    }

    public static function load(array $attributes): ?SaveLoadInterface
    {
        return new SettingsStorage($attributes);
    }
}