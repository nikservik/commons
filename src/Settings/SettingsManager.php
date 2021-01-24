<?php

namespace Nikservik\Commons\Settings;

class SettingsManager
{
    protected $settings;

    public function __construct()
    {
        $this->settings = new SettingsStorage;
    }

    public function get(string $name)
    {
        return $this->settings->get($name);
    }
}