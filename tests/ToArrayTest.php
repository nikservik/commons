<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Nikservik\TimePlace\TimePlace\AstroTime;
use Nikservik\Commons\ToArray;
use Nikservik\Commons\VirtualProperties;
use PHPUnit\Framework\TestCase;

class Inner
{
    use VirtualProperties;

    protected $end;

    public function __construct()
    {
        $this->end = Carbon::parse("2020-08-02 20:30:00");
    }

    public function getEnd()
    {
        return $this->end;
    }
}

class ArrayClass implements \JsonSerializable
{
    use ToArray;

    private $private = 15;
    protected $protected = 'secret';
    public $public = ['key' => 'value'];
    protected $time;
    private $inner;

    public function __construct()
    {
        $this->time = Carbon::parse("2020-08-02 20:30:00");
        $this->inner = new Inner;
    }

    protected $toArray = [
        'hidden' => 'private',
        'protected' => 'protected',
        'public' => 'public',
        'month' => 'time.month',
        'inday' => 'inner.end.day',
    ];
}

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
    // test comment
}