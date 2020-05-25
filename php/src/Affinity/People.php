<?php

namespace Training\Affinity;

class People extends \ArrayObject
{
    public function __construct($input = [], $flags = 0, $iterator_class = 'ArrayIterator')
    {
        parent::__construct($input, $flags, $iterator_class);
    }

    public function getCombinationCount()
    {
        return 1 << $this->count();
    }


    public function offsetSet($key, $val)
    {
        if ($val instanceof Person) {
            return parent::offsetSet($key, $val);
        }
        throw new \InvalidArgumentException('Value must be an instance of Person');
    }
}
