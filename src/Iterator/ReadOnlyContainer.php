<?php

namespace Nikservik\Commons\Iterator;

use Nikservik\Commons\Iterator\ContainableInterface;

class ReadOnlyContainer implements \ArrayAccess, \Iterator, \Countable
{
    protected $elements = [];
    protected $currentIndex;

    public function add(ContainableInterface $element): ReadOnlyContainer
    {
        $this->elements[] = $element;

        return $this;
    }

    public function __call($method, $args)
    {
        
    }

    public function clear(): void
    {
        $this->elements = [];
    }

    public function offsetExists($offset): bool
    {   
        return array_key_exists($offset, $this->elements);
    }

    public function offsetGet($offset): ?ContainableInterface
    {
        return $this->elements[$offset] ?? null;
    }

    public function offsetSet($offset, $element): void
    {
    }

    public function offsetUnset($offset): void
    {
    }

    public function current(): ContainableInterface
    {
        return $this->elements[$this->key()];
    }

    public function key(): string
    {
        return array_keys($this->elements)[$this->currentIndex];
    }

    public function next(): void
    {
        ++$this->currentIndex;
    }

    public function rewind(): void
    {
        $this->currentIndex = 0;
    }

    public function valid(): bool
    {
        return isset(array_keys($this->elements)[$this->currentIndex]);
    }

    public function count(): int 
    {
        return count($this->elements);
    }
}