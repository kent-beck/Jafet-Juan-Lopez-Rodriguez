<?php

namespace MowersController\Domain\Model\Operations\MoveOperations;

class BackwardFromNorth extends MoveOperation
{
    public static function create(): self
    {
        return new self();
    }
    
    protected function changedRow(): int
    {
        return 1;
    }

    protected function changedColumn(): int
    {
        return 0;
    }
}
