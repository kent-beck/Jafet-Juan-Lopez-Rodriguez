<?php

namespace MowersController\Domain\Model\Entities;

interface Entity
{
    public function __toString(): string;
}