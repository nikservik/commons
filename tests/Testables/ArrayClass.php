<?php

namespace Nikservik\Commons\Tests\Testables;

use Carbon\Carbon;
use JsonSerializable;
use Nikservik\Commons\ToArray;

class ArrayClass implements JsonSerializable
{
    use ToArray;

    private int $private = 15;
    protected string $protected = 'secret';
    public array $public = ['key' => 'value'];
    protected Carbon $time;
    private Inner $inner;

    public function __construct()
    {
        $this->time = Carbon::parse("2020-08-02 20:30:00");
        $this->inner = new Inner;
    }

    protected array $toArray = [
        'hidden' => 'private',
        'protected' => 'protected',
        'public' => 'public',
        'month' => 'time.month',
        'inday' => 'inner.end.day',
    ];
}
