<?php

namespace Nikservik\Commons;

trait GetProperty
{
    protected function getProperty(string $property, $object = null)
    {
        if (! $object) {
            $object = $this;
        }

        if (strpos($property, '.') === false) {
            return $object->$property;
        }

        list($innerObject, $innerProperty) = explode('.', $property, 2);

        return $this->getProperty($innerProperty, $this->getProperty($innerObject, $object));
    }
}
