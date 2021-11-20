<?php

namespace MowersController\Domain\Model\Operations;

use MowersController\Domain\Model\GrassField\GrassField;

class BackwardOperation implements Operation
{
    private const OPERATION_NAME = 'Backward';
    private const OPERATION_LETTER = 'B';
    private GrassField $field;
    
    public function __construct(GrassField $field)
    {
        $this->field = $field;
    }
    
    public function execute(): void
    {
        $this->field->moveBackward();
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
