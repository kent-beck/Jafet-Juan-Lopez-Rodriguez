<?php
declare(strict_types=1);

namespace MowersController\Domain\Model\Entities;

class VoidGridCellEntity implements Entity
{
    public static function create(): self
    {
        return new self();
    }
    
    public function __toString(): string
    {
        return '0';
    }
}
