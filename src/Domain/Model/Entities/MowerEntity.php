<?php
declare(strict_types=1);

namespace MowersController\Domain\Model\Entities;

use MowersController\Domain\Model\Orientation\Orientation;

class MowerEntity implements Entity
{
    private Orientation $orientation;
    
    public static function spawnWithOrientation(Orientation $initialOrientation): self
    {
        return new self($initialOrientation);
    }
    
    private function __construct(Orientation $initialOrientation)
    {
        $this->orientation = $initialOrientation;
    }
    
    public function __toString(): string
    {
        return $this->orientation->__toString();
    }
    
    public function turnLeft(): void
    {
    
    }
    
    public function turnRight(): void
    {
    
    }
    
    public function getOrientation(): Orientation
    {
        return $this->orientation;
    }
}
