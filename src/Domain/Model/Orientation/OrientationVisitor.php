<?php

namespace MowersController\Domain\Model\Orientation;

use MowersController\Domain\Model\Operations\MoveOperations\MoveOperation;

interface OrientationVisitor
{
    public function visitNorth(): MoveOperation;
    public function visitSouth(): MoveOperation;
    public function visitWest(): MoveOperation;
    public function visitEast(): MoveOperation;
}
