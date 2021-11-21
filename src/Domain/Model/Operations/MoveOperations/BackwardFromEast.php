<?php

namespace MowersController\Domain\Model\Operations\MoveOperations;

class BackwardFromEast extends MoveOperation
{
    public static function create(): self
    {
        return new self();
    }
    
    protected function changedRow(): int
    {
        return 0;
    }

    protected function changedColumn(): int
    {
        return -1;
    }
}
