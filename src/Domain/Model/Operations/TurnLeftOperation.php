<?php

namespace MowersController\Domain\Model\Operations;

use MowersController\Domain\Model\Entities\MowerEntity;

class TurnLeftOperation implements Operation
{
    public const OPERATION_NAME = 'Left';
    public const OPERATION_LETTER = 'L';
    private MowerEntity $mowerEntity;
    
    public static function create(MowerEntity $mowerEntity): self
    {
        return new self($mowerEntity);
    }
    
    private function __construct(MowerEntity $mowerEntity)
    {
        $this->mowerEntity = $mowerEntity;
    }

    public function execute(): void
    {
        $this->mowerEntity->turnLeft();
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
