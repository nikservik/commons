<?php

namespace Nikservik\Commons\Tests;

use Exception;
use Nikservik\Commons\Tests\Testables\WithAccessors;
use Nikservik\Commons\Tests\Testables\WithoutAccessors;
use PHPUnit\Framework\TestCase;

class VirtualPropertiesTest extends TestCase
{
    public function testGet()
    {
        $good = new WithAccessors('good');
        $bad = new WithoutAccessors('bad');

        $this->assertEquals('good', $good->private);

        $this->expectException(Exception::class);
        $this->assertEquals('bad', $bad->private);
    }

    public function testSet()
    {
        $good = new WithAccessors('good');
        $bad = new WithoutAccessors('bad');

        $this->assertEquals('good', $good->private);
        $good->private = 'new good';
        $this->assertEquals('new good', $good->private);

        $this->expectException(Exception::class);
        $good->private = 'new bad';
        $this->assertEquals('new bad', $bad->private);
    }
}
