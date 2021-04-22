<?php

namespace Nikservik\Commons\Iterator;

interface ContainableNamedInterface extends ContainableInterface
{
    public function getName(): string;
}
