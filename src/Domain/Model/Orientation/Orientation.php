<?php
declare(strict_types=1);

namespace MowersController\Domain\Model\Orientation;

interface Orientation
{
    const ORIENTATION_NORTH = 'north';
    const ORIENTATION_EAST = 'east';
    const ORIENTATION_WEST = 'west';
    const ORIENTATION_SOUTH = 'south';
    
    public function right(): string;
    public function left(): string;
    public function __toString();
}
