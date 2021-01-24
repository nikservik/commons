<?php

namespace Nikservik\Commons\Interfaces;

interface SaveLoadInterface
{
    public function toSave(): array;
    public static function load(array $attributes): ?SaveLoadInterface;
}