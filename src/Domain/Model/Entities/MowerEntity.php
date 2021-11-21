<?php
declare(strict_types=1);

namespace MowersController\Domain\Model\Entities;

use MowersController\Domain\Model\Orientation\Orientation;
use MowersController\Domain\Model\Orientation\OrientationFactory;

class MowerEntity implements Entity
{
    private Orientation $orientation;
    
    public static function createWithOrientation(Orientation $initialOrientation): self
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
        $this->orientation = OrientationFactory::createInstance()->getOrientation($this->orientation->left());
    }
    
    public function turnRight(): void
    {
        $this->orientation = OrientationFactory::createInstance()->getOrientation($this->orientation->right());
    }
    
    public function getOrientation(): Orientation
    {
        return $this->orientation;
    }
}
