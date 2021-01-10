<?php

namespace Tests\Commons\Iterator;

use Faker\Factory;
use Nikservik\Commons\Iterator\ContainableNamedInterface;
use Nikservik\Commons\Iterator\ReadOnlyGeneratedContainer;
use PHPUnit\Framework\TestCase;

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

        $this->assertEquals(2, count($elements));
    }

    public function testIterate()
    {
        $elements = new ReadOnlyGeneratedTestable;

        foreach ($elements as $name => $element)
            $this->assertEquals($name, $element->getName());
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