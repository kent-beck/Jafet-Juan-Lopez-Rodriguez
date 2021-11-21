<?php

namespace MowersController\Domain\Model\Orientation;

use MowersController\Domain\Model\Operations\MoveOperations\MoveOperation;

class North implements Orientation
{
    public static function create(): self
    {
        return new self();
    }
    
    public function right(): string
    {
        return self::ORIENTATION_EAST_LETTER;
    }

    public function left(): string
    {
        return self::ORIENTATION_WEST_LETTER;
    }

    public function __toString()
    {
        return '↑';
    }
    
    public function getLetter(): string
    {
        return self::ORIENTATION_NORTH_LETTER;
    }

    public function accept(OrientationVisitor $visitor): MoveOperation
    {
        return $visitor->visitNorth();
    }
}
