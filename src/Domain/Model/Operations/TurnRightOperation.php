<?php

namespace MowersController\Domain\Model\Operations;

use MowersController\Domain\Model\Entities\MowerEntity;

class TurnRightOperation implements Operation
{
    private const OPERATION_NAME = 'Right';
    private const OPERATION_LETTER = 'R';
    private MowerEntity $mowerEntity;
    
    public function __construct(MowerEntity $mowerEntity)
    {
        $this->mowerEntity = $mowerEntity;
    }
    
    public function execute(): void
    {
        $this->mowerEntity->turnRight();
    }
    
    public function operationName(): string
    {
        return self::OPERATION_NAME;
    }
    
    public function operationLetter(): string
    {
        return self::OPERATION_LETTER;
    }
}
