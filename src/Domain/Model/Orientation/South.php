<?php

namespace MowersController\Domain\Model\Orientation;

class South implements Orientation
{
    public static function create(): self
    {
        return new self();
    }
    
    public function right(): string
    {
        return self::ORIENTATION_WEST;
    }

    public function left(): string
    {
        return self::ORIENTATION_EAST;
    }

    public function __toString()
    {
       return '↓';
    }

    public function accept(OrientationVisitor $visitor)
    {
        return $visitor->visitSouth();
    }
}
