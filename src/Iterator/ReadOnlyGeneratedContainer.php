<?php

namespace Nikservik\Commons\Iterator;

abstract class ReadOnlyGeneratedContainer extends ReadOnlyNamedContainer
{
    protected array $allowedElements;

    public function __construct(array $allowedElements)
    {
        $this->allowedElements = $allowedElements;
    }

    public function getElement(string $name, string $method = ''): ?ContainableNamedInterface
    {
        if (! in_array($name, $this->allowedElements))
            return null;

        if (! isset($this->elements[$name][$method]))
            $this->elements[$name][$method] = $this->generateElement($name, $method);

        return $this->elements[$name][$method];
    }

    abstract public function generateElement(string $name, string $method = ''): ContainableNamedInterface;

    public function add(ContainableInterface $element): ReadOnlyGeneratedContainer
    {
        return $this;
    }

    public function has(string $name): bool
    {
        return in_array($name, $this->allowedElements);
    }

    public function offsetExists($offset): bool
    {
        return $this->has($offset);
    }

    public function offsetGet($offset): ?ContainableNamedInterface
    {
        return $this->getElement($offset);
    }

    public function key(): string
    {
        return $this->allowedElements[$this->currentIndex];
    }

    public function current(): ContainableInterface
    {
        return $this->getElement($this->key());
    }

    public function valid(): bool
    {
        return isset($this->allowedElements[$this->currentIndex]);
    }

    public function count(): int
    {
        return count($this->allowedElements);
    }
}
