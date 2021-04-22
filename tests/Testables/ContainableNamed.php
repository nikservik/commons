<?php

namespace Nikservik\Commons\Tests\Testables;

use Faker\Factory;
use Nikservik\Commons\Iterator\ContainableNamedInterface;

class ContainableNamed implements ContainableNamedInterface
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function factory(array $options = []): ContainableNamed
    {
        $faker = Factory::create();

        return new ContainableNamed($options['name'] ?? $faker->name);
    }
}
