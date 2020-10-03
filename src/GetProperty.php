<?php

namespace Nikservik\Commons;

use Illuminate\Support\Str;

trait GetProperty
{
    protected function getProperty(string $property, $object = null)
    {
        if (! $object) 
            $object = $this;

        if (! Str::contains($property, '.')) 
            return $object->$property;

        list($innerObject, $innerProperty) = explode('.', $property, 2);
        
        return $this->getProperty($innerProperty, $this->getProperty($innerObject, $object));
    }
}