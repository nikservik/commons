<?php

namespace Nikservik\Commons\Tests\Iterator;

use Nikservik\Commons\Iterator\ReadOnlyContainer;
use Nikservik\Commons\Tests\Testables\Containable;
use PHPUnit\Framework\TestCase;

class ReadOnlyContainerTest extends TestCase
{
    public function testCount()
    {
        $elements = new ReadOnlyContainer;

        $this->assertEquals(0, $elements->count());
    }

    public function testCountArray()
    {
        $elements = new ReadOnlyContainer;

        $this->assertCount(0, $elements);
    }

    public function testAdd()
    {
        $elements = (new ReadOnlyContainer)->add($element = new Containable);

        $this->assertCount(1, $elements);
        $this->assertInstanceOf(Containable::class, $elements[0]);
        $this->assertEquals($element, $elements[0]);
    }

    public function testClear()
    {
        $elements = (new ReadOnlyContainer)
            ->add(new Containable)
            ->add(new Containable);

        $elements->clear();

        $this->assertEquals(0, count($elements));
    }

    public function testOffsetExists()
    {
        $elements = (new ReadOnlyContainer)->add(new Containable);

        $this->assertTrue($elements->offsetExists(0));
    }

    public function testOffsetExistsArray()
    {
        $elements = (new ReadOnlyContainer)->add(new Containable);

        $this->assertTrue(isset($elements[0]));
    }

    public function testOffsetExistsFalse()
    {
        $elements = new ReadOnlyContainer;

        $this->assertFalse($elements->offsetExists(2));
    }

    public function testOffsetExistsArrayFalse()
    {
        $elements = new ReadOnlyContainer;

        $this->assertFalse(isset($elements[2]));
    }

    public function testOffsetGet()
    {
        $elements = (new ReadOnlyContainer)->add($element = new Containable());

        $this->assertTrue($element === $elements->offsetGet(0));
    }

    public function testOffsetGetArray()
    {
        $elements = (new ReadOnlyContainer)->add($element = new Containable());

        $this->assertTrue($element === $elements[0]);
    }

    public function testOffsetGetNull()
    {
        $elements = new ReadOnlyContainer;

        $this->assertNull($elements->offsetGet(3));
    }

    public function testOffsetGetArrayNull()
    {
        $elements = new ReadOnlyContainer;

        $this->assertNull($elements[3]);
    }

    public function testOffsetSetDoNothing()
    {
        $elements = new ReadOnlyContainer;

        $elements->offsetSet(1, new Containable());

        $this->assertNull($elements->offsetGet(1));
    }

    public function testOffsetUnsetDoNothing()
    {
        $elements = (new ReadOnlyContainer)->add(new Containable(['element' => 'Mo']));

        $elements->offsetUnset(0);

        $this->assertInstanceOf(Containable::class, $elements[0]);
    }

    public function testIterate()
    {
        $elements = (new ReadOnlyContainer)
            ->add(new Containable())
            ->add(new Containable());

        foreach ($elements as $index => $element) {
            $this->assertEquals($element, $elements[$index]);
        }
    }
}
