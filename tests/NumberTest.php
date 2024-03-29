<?php

namespace Nikservik\Commons\Tests;

use Nikservik\Commons\Number;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    public function testOrdinalZero()
    {
        $this->assertEquals('0th', Number::ordinal(0));
    }

    public function testOrdinalFirst()
    {
        $this->assertEquals('1st', Number::ordinal(1));
    }

    public function testOrdinalSecond()
    {
        $this->assertEquals('2nd', Number::ordinal(2));
    }

    public function testOrdinalThird()
    {
        $this->assertEquals('3rd', Number::ordinal(3));
    }

    public function testOrdinalFourth()
    {
        $this->assertEquals('4th', Number::ordinal(4));
    }

    public function testOrdinalEleventh()
    {
        $this->assertEquals('11th', Number::ordinal(11));
    }

    public function testOrdinalThirteenth()
    {
        $this->assertEquals('13th', Number::ordinal(13));
    }

    public function testOrdinal22()
    {
        $this->assertEquals('22nd', Number::ordinal(22));
    }

    public function testOrdinal25()
    {
        $this->assertEquals('25th', Number::ordinal(25));
    }

    public function testOrdinal101()
    {
        $this->assertEquals('101st', Number::ordinal(101));
    }

    public function testOrdinal302()
    {
        $this->assertEquals('302nd', Number::ordinal(302));
    }

    public function testOrdinal1203()
    {
        $this->assertEquals('1203rd', Number::ordinal(1203));
    }

    public function testOrdinal50204()
    {
        $this->assertEquals('50204th', Number::ordinal(50204));
    }

    public function testOrdinal2011()
    {
        $this->assertEquals('2011th', Number::ordinal(2011));
    }

    public function testOrdinal313()
    {
        $this->assertEquals('313th', Number::ordinal(313));
    }

    public function testOrdinal452()
    {
        $this->assertEquals('452nd', Number::ordinal(452));
    }

    public function testOrdinal578()
    {
        $this->assertEquals('578th', Number::ordinal(578));
    }

    public function testOrdinal100()
    {
        $this->assertEquals('100th', Number::ordinal(100));
    }

    public function testOrdinal500()
    {
        $this->assertEquals('500th', Number::ordinal(500));
    }

    public function testOrdinal1000()
    {
        $this->assertEquals('1000th', Number::ordinal(1000));
    }

    public function testOrdinal5000()
    {
        $this->assertEquals('5000th', Number::ordinal(5000));
    }

    public function testBetweenNormal()
    {
        $this->assertTrue(Number::between(3, 6, 12));
    }

    public function testBetweenNormalBefore()
    {
        $this->assertFalse(Number::between(6, 3, 12));
    }

    public function testBetweenNormalAfter()
    {
        $this->assertFalse(Number::between(3, 12, 6));
    }

    public function testBetweenReverse()
    {
        $this->assertTrue(Number::between(12, 6, 3));
    }

    public function testBetweenReverseBefore()
    {
        $this->assertFalse(Number::between(6, 12, 3));
    }

    public function testBetweenReverseAfter()
    {
        $this->assertFalse(Number::between(12, 3, 6));
    }

    public function testPluralRu1()
    {
        $this->assertEquals('1 год', Number::pluralRu(1, ['год', 'года', 'лет']));
    }

    public function testPluralRu2()
    {
        $this->assertEquals('2 года', Number::pluralRu(2, ['год', 'года', 'лет']));
    }

    public function testPluralRu4()
    {
        $this->assertEquals('4 года', Number::pluralRu(4, ['год', 'года', 'лет']));
    }

    public function testPluralRu5()
    {
        $this->assertEquals('5 лет', Number::pluralRu(5, ['год', 'года', 'лет']));
    }

    public function testPluralRu10()
    {
        $this->assertEquals('10 лет', Number::pluralRu(10, ['год', 'года', 'лет']));
    }

    public function testPluralRu11()
    {
        $this->assertEquals('11 лет', Number::pluralRu(11, ['год', 'года', 'лет']));
    }

    public function testPluralRu14()
    {
        $this->assertEquals('14 лет', Number::pluralRu(14, ['год', 'года', 'лет']));
    }

    public function testPluralRu21()
    {
        $this->assertEquals('21 год', Number::pluralRu(21, ['год', 'года', 'лет']));
    }

    public function testPluralRu55()
    {
        $this->assertEquals('55 лет', Number::pluralRu(55, ['год', 'года', 'лет']));
    }

    public function testPluralRu100()
    {
        $this->assertEquals('100 лет', Number::pluralRu(100, ['год', 'года', 'лет']));
    }

    public function testPluralRu101()
    {
        $this->assertEquals('101 год', Number::pluralRu(101, ['год', 'года', 'лет']));
    }
}
