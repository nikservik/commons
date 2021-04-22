<?php

namespace Nikservik\Commons\Tests\Iterator;

use Nikservik\Commons\Iterator\ReadOnlyNamedContainer;
use Nikservik\Commons\Tests\Testables\ContainableNamed;
use PHPUnit\Framework\TestCase;

class ReadOnlyNamedContainerTest extends TestCase
{
    public function testCount()
    {
        $elements = new ReadOnlyNamedContainer;

        $this->assertEquals(0, $elements->count());
    }

    public function testCountArray()
    {
        $elements = new ReadOnlyNamedContainer;

        $this->assertCount(0, $elements);
    }

    public function testAdd()
    {
        $elements = (new ReadOnlyNamedContainer)->add(ContainableNamed::factory(['name' => 'Mo']));

        $this->assertCount(1, $elements);
        $this->assertInstanceOf(ContainableNamed::class, $elements[0]);
        $this->assertEquals('Mo', $elements[0]->getName());
    }

    public function testHas()
    {
        $elements = (new ReadOnlyNamedContainer)
            ->add(ContainableNamed::factory(['name' => 'Mo']))
            ->add(ContainableNamed::factory(['name' => 'Su']));

        $this->assertTrue($elements->has('Su'));
        $this->assertFalse($elements->has('Ma'));
    }

    public function testHasFalseOnEmpty()
    {
        $elements = (new ReadOnlyNamedContainer);

        $this->assertFalse($elements->has('Ma'));
    }

    public function testClear()
    {
        $elements = (new ReadOnlyNamedContainer)
            ->add(ContainableNamed::factory(['name' => 'Mo']))
            ->add(ContainableNamed::factory(['name' => 'Su']));

        $elements->clear();

        $this->assertCount(0, $elements);
    }

    public function testOffsetExists()
    {
        $elements = (new ReadOnlyNamedContainer)->add(ContainableNamed::factory());

        $this->assertTrue($elements->offsetExists(0));
    }

    public function testOffsetExistsArray()
    {
        $elements = (new ReadOnlyNamedContainer)->add(ContainableNamed::factory());

        $this->assertTrue(isset($elements[0]));
    }

    public function testOffsetExistsFalse()
    {
        $elements = new ReadOnlyNamedContainer;

        $this->assertFalse($elements->offsetExists(2));
    }

    public function testOffsetExistsByName()
    {
        $elements = (new ReadOnlyNamedContainer)->add(ContainableNamed::factory(['name' => 'Mo']));

        $this->assertTrue($elements->offsetExists('Mo'));
    }

    public function testOffsetExistsByNameFalse()
    {
        $elements = (new ReadOnlyNamedContainer)->add(ContainableNamed::factory(['name' => 'Mo']));

        $this->assertFalse($elements->offsetExists('Su'));
    }

    public function testOffsetExistsArrayFalse()
    {
        $elements = new ReadOnlyNamedContainer;

        $this->assertFalse(isset($elements[2]));
    }

    public function testOffsetGet()
    {
        $elements = (new ReadOnlyNamedContainer)->add($element = ContainableNamed::factory());

        $this->assertTrue($element === $elements->offsetGet(0));
    }

    public function testOffsetGetArray()
    {
        $elements = (new ReadOnlyNamedContainer)->add($element = ContainableNamed::factory());

        $this->assertTrue($element === $elements[0]);
    }

    public function testOffsetGetNull()
    {
        $elements = new ReadOnlyNamedContainer;

        $this->assertNull($elements->offsetGet(3));
    }

    public function testOffsetGetArrayNull()
    {
        $elements = new ReadOnlyNamedContainer;

        $this->assertNull($elements[3]);
    }

    public function testOffsetGetByName()
    {
        $elements = (new ReadOnlyNamedContainer)->add($element = ContainableNamed::factory(['name' => 'Mo']));

        $this->assertTrue($element === $elements->offsetGet('Mo'));
    }

    public function testOffsetGetByNameNull()
    {
        $elements = (new ReadOnlyNamedContainer)->add(ContainableNamed::factory(['name' => 'Mo']));

        $this->assertNull($elements->offsetGet('Su'));
    }

    public function testOffsetSetDoNothing()
    {
        $elements = new ReadOnlyNamedContainer;

        $elements->offsetSet(1, ContainableNamed::factory());

        $this->assertNull($elements->offsetGet(1));
    }

    public function testOffsetUnsetDoNothing()
    {
        $elements = (new ReadOnlyNamedContainer)->add(ContainableNamed::factory(['name' => 'Mo']));

        $elements->offsetUnset(0);

        $this->assertInstanceOf(ContainableNamed::class, $elements[0]);
        $this->assertEquals('Mo', $elements[0]->getName());
    }

    public function testIterate()
    {
        $elements = (new ReadOnlyNamedContainer)
            ->add(ContainableNamed::factory())
            ->add(ContainableNamed::factory());

        foreach ($elements as $index => $element)
            $this->assertEquals($element, $elements[$index]);
    }
}
