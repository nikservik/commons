<?php

namespace Nikservik\Commons\Tests\Testables;

use Nikservik\Commons\Iterator\ContainableNamedInterface;
use Nikservik\Commons\Iterator\ReadOnlyGeneratedContainer;

class ReadOnlyGeneratedTestable extends ReadOnlyGeneratedContainer
{
    public function __construct()
    {
        parent::__construct(['Mo', 'Su']);
    }

    public function generateElement(string $name, string $method = ''): ContainableNamedInterface
    {
        return new ContainableNamed($name);
    }
}
