<?php

namespace MowersController\Domain\Model\Operations;

interface Operation
{
    public function execute();
    public function operationName(): string;
    public function operationLetter(): string;
}
