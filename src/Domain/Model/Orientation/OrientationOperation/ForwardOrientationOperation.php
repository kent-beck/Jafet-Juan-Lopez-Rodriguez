<?php

namespace MowersController\Domain\Model\Orientation\OrientationOperation;

use MowersController\Domain\Model\Entities\MowerEntity;
use MowersController\Domain\Model\Orientation\OrientationVisitor;
use MowersController\Domain\Model\Operations\MoveOperations\MoveOperation;

class ForwardOrientationOperation implements OrientationVisitor
{
    private MowerEntity $mower;
    
    public static function create(MowerEntity $mowerEntity): self
    {
        return new self($mowerEntity);
    }
    
    private function __construct(MowerEntity $mowerEntity)
    {
        $this->mower = $mowerEntity;
    }
    
    public function execute(): MoveOperation
    {
        return $this->mower->getOrientation()->accept($this);
    }
    
    public function visitNorth()
    {
        return new ForwardFromNorth();
    }
    
    public function visitSouth()
    {
        return new ForwardFromSouth();
    }
    
    public function visitEast()
    {
        return new ForwardFromEast();
    }
    
    public function visitWest()
    {
        return new ForwardFromWest();
    }
}
