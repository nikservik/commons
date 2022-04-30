<?php

namespace Nikservik\Commons\Tests;

use Nikservik\Commons\CArr;
use PHPUnit\Framework\TestCase;

class CArrTest extends TestCase
{
    public function test_merges()
    {
        $merged = CArr::merge(
            ['a' => 2],
            ['b' => 3]
        );

        $this->assertArrayHasKey('a', $merged);
        $this->assertArrayHasKey('b', $merged);
    }

    public function test_merges_deep()
    {
        $merged = CArr::merge(
            ['a' => 2, 'c' => ['ca' => 4]],
            ['b' => 3, 'c' => ['cb' => 5]]
        );

        $this->assertArrayHasKey('ca', $merged['c']);
        $this->assertArrayHasKey('cb', $merged['c']);
    }

    public function test_replaces()
    {
        $merged = CArr::merge(
            ['a' => 2],
            ['a' => 3]
        );

        $this->assertArrayHasKey('a', $merged);
        $this->assertEquals(3, $merged['a']);
    }

    public function test_replaces_deep()
    {
        $merged = CArr::merge(
            ['a' => 2, 'c' => ['ca' => 4]],
            ['b' => 3, 'c' => ['ca' => 5]]
        );

        $this->assertArrayHasKey('ca', $merged['c']);
        $this->assertEquals(5, $merged['c']['ca']);
    }

    public function test_replaces_deep_and_leave_other()
    {
        $merged = CArr::merge(
            ['a' => 2, 'c' => ['ca' => 4, 'cc' => 6]],
            ['b' => 3, 'c' => ['ca' => 5]]
        );

        $this->assertArrayHasKey('cc', $merged['c']);
        $this->assertEquals(6, $merged['c']['cc']);
    }
}
