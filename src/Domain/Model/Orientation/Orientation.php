<?php
declare(strict_types=1);

namespace MowersController\Domain\Model\Orientation;

interface Orientation
{
    public const ORIENTATION_NORTH = 'north';
    public const ORIENTATION_EAST = 'east';
    public const ORIENTATION_WEST = 'west';
    public const ORIENTATION_SOUTH = 'south';
    public const ORIENTATION_NORTH_LETTER = 'N';
    public const ORIENTATION_EAST_LETTER = 'E';
    public const ORIENTATION_WEST_LETTER = 'W';
    public const ORIENTATION_SOUTH_LETTER = 'S';
    
    public function right(): string;
    public function left(): string;
    public function getLetter(): string;
    public function __toString();
}
