<?php

namespace MowersController\Domain\Model\Orientation\OrientationOperation;

use MowersController\Domain\Model\Entities\MowerEntity;
use MowersController\Domain\Model\Operations\MoveOperations\ForwardFromEast;
use MowersController\Domain\Model\Operations\MoveOperations\ForwardFromNorth;
use MowersController\Domain\Model\Operations\MoveOperations\ForwardFromSouth;
use MowersController\Domain\Model\Operations\MoveOperations\ForwardFromWest;
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
    
    public function visitNorth(): MoveOperation
    {
        return ForwardFromNorth::create();
    }
    
    public function visitSouth(): MoveOperation
    {
        return ForwardFromSouth::create();
    }
    
    public function visitEast(): MoveOperation
    {
        return ForwardFromEast::create();
    }
    
    public function visitWest(): MoveOperation
    {
        return ForwardFromWest::create();
    }
}
