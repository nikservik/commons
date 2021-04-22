<?php

namespace Nikservik\Commons\Tests\Testables;

use Nikservik\Commons\VirtualProperties;

class WithAccessors
{
    use VirtualProperties;

    private $private;

    public function __construct($private)
    {
        $this->private = $private;
    }

    public function getPrivate()
    {
        return $this->private;
    }

    public function setPrivate($private)
    {
        return $this->private = $private;
    }
}
