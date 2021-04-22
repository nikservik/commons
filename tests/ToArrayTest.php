<?php

namespace Nikservik\Commons\Tests;

use Nikservik\Commons\Tests\Testables\ArrayClass;
use PHPUnit\Framework\TestCase;

class ToArrayTest extends TestCase
{
    public function testToArray()
    {
        $class = new ArrayClass;
        $array = $class->toArray();

        $this->assertEquals(15, $array['hidden']);
        $this->assertEquals('secret', $array['protected']);
        $this->assertEquals('value', $array['public']['key']);
        $this->assertEquals(8, $array['month']);
        $this->assertEquals(2, $array['inday']);
    }

    public function testJsonEncode()
    {
        $class = new ArrayClass;
        $array = json_decode(json_encode($class), true);

        $this->assertEquals(15, $array['hidden']);
        $this->assertEquals('secret', $array['protected']);
        $this->assertEquals('value', $array['public']['key']);
    }
}
