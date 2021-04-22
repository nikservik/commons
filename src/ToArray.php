<?php

namespace Nikservik\Commons;

trait ToArray
{
    use GetProperty;

    public function toArray(): array
    {
        if (! property_exists($this, 'toArray'))
            return [];

        $array = [];
        foreach ($this->toArray as $name => $property) {
            $array[$name] = $this->getProperty($property);
        }

        return $array;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
