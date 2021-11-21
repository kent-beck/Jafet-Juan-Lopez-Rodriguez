<?php
declare(strict_types=1);

namespace MowersController\Domain\Model\FileData;

use MowersController\Domain\Model\Coordinates\Coordinates;
use MowersController\Domain\Model\Orientation\Orientation;

class InputData
{
    private Coordinates $fieldCoords;
    private Coordinates $spawnCoords;
    private Orientation $orientation;
    private array $movCommands = [];
    
    private function __construct(
        Coordinates $fieldCoords,
        Coordinates $spawnCoords,
        Orientation $orientation,
        array $movCommands
    ) {
        $this->fieldCoords = $fieldCoords;
        $this->spawnCoords = $spawnCoords;
        $this->orientation = $orientation;
        $this->movCommands = $movCommands;
    }
    
    public static function createWithData(
        Coordinates $fieldCoords,
        Coordinates $spawnCoords,
        Orientation $orientation,
        array $movCommands
    ): self {
        return new self($fieldCoords, $spawnCoords, $orientation, $movCommands);
    }
    
    public function getFieldCoords(): Coordinates
    {
        return $this->fieldCoords;
    }
    
    public function getSpawnCoords(): Coordinates
    {
        return $this->spawnCoords;
    }
    
    public function getOrientation(): Orientation
    {
        return $this->orientation;
    }
    
    public function getMovCommands(): array
    {
        return $this->movCommands;
    }
}
