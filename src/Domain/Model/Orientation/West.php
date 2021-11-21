<?php

namespace MowersController\Domain\Model\Orientation;

class West implements Orientation
{
    public static function create(): self
    {
        return new self();
    }
    
    public function right(): string
    {
        return self::ORIENTATION_NORTH;
    }

    public function left(): string
    {
        return self::ORIENTATION_SOUTH;
    }

    public function __toString()
    {
        return '←';
    }

    public function accept(OrientationVisitor $visitor)
    {
        return $visitor->visitWest();
    }
}
