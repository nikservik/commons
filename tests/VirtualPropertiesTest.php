<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
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

class VirtualPropertiesTest extends TestCase
{
    public function testGet()
    {
        $good = new WithAccessors('good');
        $bad = new WithoutAccessors('bad');

        $this->assertEquals('good', $good->private);

        $this->expectException(\Exception::class);
        $this->assertEquals('bad', $bad->private);
    }

    public function testSet()
    {
        $good = new WithAccessors('good');
        $bad = new WithoutAccessors('bad');

        $this->assertEquals('good', $good->private);
        $good->private = 'new good';
        $this->assertEquals('new good', $good->private);

        $this->expectException(\Exception::class);
        $good->private = 'new bad';
        $this->assertEquals('new bad', $bad->private);
    }
}
