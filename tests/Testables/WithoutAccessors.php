<?php

namespace Nikservik\Commons\Tests\Testables;

use Nikservik\Commons\VirtualProperties;

class WithoutAccessors
{
    use VirtualProperties;

    private $private;

    public function __construct($private)
    {
        $this->private = $private;
    }
}
