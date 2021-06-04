<?php

namespace Nikservik\Commons\Tests\Translatable;

use Nikservik\Commons\Tests\TestCase;
use Nikservik\Commons\Translatable\Translatable;
use Nikservik\Commons\Translatable\TranslatableField;

class TranslatableFieldTest extends TestCase
{

    public function testGet()
    {
        $casted = (new TranslatableField)->get(null, null, '{"ru":"test"}', null);

        $this->assertInstanceOf(Translatable::class, $casted);
        $this->assertEquals('test', $casted->ru);
    }

    public function testSet()
    {
        $json = (new TranslatableField)->set(null, null, new Translatable(['ru' => 'test']), null);

        $this->assertEquals('{"ru":"test"}', $json);
    }
}
