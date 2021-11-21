<?php

namespace MowersController\Domain\Model\Orientation;

interface OrientationVisitor
{
    public function visitNorth();
    public function visitSouth();
    public function visitWest();
    public function visitEast();
}
