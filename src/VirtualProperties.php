<?php

namespace Nikservik\Commons;

trait VirtualProperties
{
    public function __get($property)
    {
        $getter = 'get'.ucfirst($property);

        if (! method_exists($this, $getter))
            throw new \Exception('Trying to get undefined or private property "'.$property.'"');

        return $this->{$getter}();
    }

    public function __set($property, $value)
    {
        $setter = 'set'.ucfirst($property);

        if (! method_exists($this, $setter))
            throw new \Exception('Trying to set undefined or private property "'.$property.'"');

        return $this->{$setter}($value);
    }
}