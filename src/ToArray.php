<?php

namespace Nikservik\Commons;

use Illuminate\Support\Str;
use Nikservik\Commons\GetProperty;

trait ToArray
{
    use GetProperty;
    
    public function toArray()
    {
        if (! property_exists($this, 'toArray')) 
            return [];

        $array = [];
        foreach ($this->toArray as $name => $property) {
            $array[$name] = $this->getProperty($property);
        }        

        return $array;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}