<?php

namespace Fulcrum\Tests\Extender\Str;

class StringableObjectStub
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
