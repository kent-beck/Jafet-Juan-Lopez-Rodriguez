<?php

namespace MowersController\Domain\Model\Orientation\OrientationOperation;

use MowersController\Domain\Model\Entities\MowerEntity;
use MowersController\Domain\Model\Operations\MoveOperations\BackwardFromEast;
use MowersController\Domain\Model\Operations\MoveOperations\BackwardFromNorth;
use MowersController\Domain\Model\Operations\MoveOperations\BackwardFromSouth;
use MowersController\Domain\Model\Operations\MoveOperations\BackwardFromWest;
use MowersController\Domain\Model\Orientation\OrientationVisitor;
use MowersController\Domain\Model\Operations\MoveOperations\MoveOperation;

class BackwardOrientationOperation implements OrientationVisitor
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
    
    public function visitNorth(): MoveOperation
    {
        return BackwardFromNorth::create();
    }
    
    public function visitSouth(): MoveOperation
    {
        return BackwardFromSouth::create();
    }
    
    public function visitEast(): MoveOperation
    {
        return BackwardFromEast::create();
    }
    
    public function visitWest(): MoveOperation
    {
        return BackwardFromWest::create();
    }
}
