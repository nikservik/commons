<?php

namespace Nikservik\Commons\Tests\Testables;

use Carbon\Carbon;
use Nikservik\Commons\VirtualProperties;

class Inner
{
    use VirtualProperties;

    protected Carbon $end;

    public function __construct()
    {
        $this->end = Carbon::parse("2020-08-02 20:30:00");
    }

    public function getEnd(): Carbon
    {
        return $this->end;
    }
}
