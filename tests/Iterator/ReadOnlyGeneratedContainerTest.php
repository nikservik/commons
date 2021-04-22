<?php

namespace Nikservik\Commons\Tests\Iterator;

use Nikservik\Commons\Tests\Testables\ContainableNamed;
use Nikservik\Commons\Tests\Testables\ReadOnlyGeneratedTestable;
use PHPUnit\Framework\TestCase;

class ReadOnlyGeneratedContainerTest extends TestCase
{
    public function testCount()
    {
        $elements = new ReadOnlyGeneratedTestable;

        $this->assertEquals(2, $elements->count());
    }

    public function testCountArray()
    {
        $elements = new ReadOnlyGeneratedTestable;

        $this->assertCount(2, $elements);
    }

    public function testIterate()
    {
        $elements = new ReadOnlyGeneratedTestable;

        foreach ($elements as $name => $element) {
            $this->assertEquals($name, $element->getName());
        }
    }

    public function testOffsetExists()
    {
        $elements = new ReadOnlyGeneratedTestable;

        $this->assertTrue($elements->offsetExists('Mo'));
    }

    public function testOffsetExistsArray()
    {
        $elements = new ReadOnlyGeneratedTestable;

        $this->assertTrue(isset($elements['Su']));
    }

    public function testOffsetExistsFalse()
    {
        $elements = new ReadOnlyGeneratedTestable;

        $this->assertFalse($elements->offsetExists('Du'));
    }

    public function testOffsetExistsArrayFalse()
    {
        $elements = new ReadOnlyGeneratedTestable;

        $this->assertFalse(isset($elements['Du']));
    }

    public function testOffsetGet()
    {
        $elements = new ReadOnlyGeneratedTestable;

        $this->assertInstanceOf(ContainableNamed::class, $elements->offsetGet('Mo'));
        $this->assertEquals('Mo', $elements->offsetGet('Mo')->getName());
    }

    public function testOffsetGetArray()
    {
        $elements = new ReadOnlyGeneratedTestable;

        $this->assertEquals('Mo', $elements['Mo']->getName());
    }

    public function testOffsetGetNull()
    {
        $elements = new ReadOnlyGeneratedTestable;

        $this->assertNull($elements->offsetGet('Du'));
    }

    public function testOffsetGetArrayNull()
    {
        $elements = new ReadOnlyGeneratedTestable;

        $this->assertNull($elements['Du']);
    }
}
