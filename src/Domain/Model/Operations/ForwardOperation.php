<?php

namespace MowersController\Domain\Model\Operations;

use MowersController\Domain\Model\GrassField\GrassField;

class ForwardOperation implements Operation
{
    public const OPERATION_NAME = 'Forward';
    public const OPERATION_LETTER = 'M';
    private GrassField $field;
    
    public static function create(GrassField $field): self
    {
        return new self($field);
    }
    
    private function __construct(GrassField $field)
    {
        $this->field = $field;
    }

    public function execute(): void
    {
        $this->field->moveForward();
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
