<?php

namespace Nikservik\Commons\Iterator;

use Nikservik\Commons\Iterator\ContainableNamedInterface;
use Nikservik\Commons\Iterator\ReadOnlyContainer;

class ReadOnlyNamedContainer extends ReadOnlyContainer
{
    public function add(ContainableInterface $element): ReadOnlyNamedContainer
    {
        if ($element instanceof ContainableNamedInterface)
            $this->elements[] = $element;

        return $this;
    }

    public function has(string $name): bool
    {
        foreach ($this->elements as $element)
            if ($element->getName() == $name)
                return true;

        return false;
    }

    public function offsetExists($offset): bool
    {   
        if (is_string($offset))
            return $this->has($offset);

        return parent::offsetExists($offset);
    }

    public function offsetGet($offset): ?ContainableNamedInterface
    {
        if (is_string($offset)) 
            foreach ($this->elements as $element)
                if ($element->getName() == $offset)
                    return $element;

        return parent::offsetGet($offset);
    }
}