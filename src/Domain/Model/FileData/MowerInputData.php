<?php
declare(strict_types=1);

namespace MowersController\Domain\Model\FileData;

use MowersController\Domain\Model\Coordinates\Coordinates;
use MowersController\Domain\Model\Orientation\Orientation;

class MowerInputData
{
    private Coordinates $spawnCoords;
    private Orientation $startOrientation;
    private array $movCommands = [];
    
    private function __construct(
        Coordinates $spawnCoords,
        Orientation $orientation,
        array $movCommands
    ) {
        $this->spawnCoords = $spawnCoords;
        $this->startOrientation = $orientation;
        $this->movCommands = $movCommands;
    }
    
    public static function createWithSpawnDataAndMovements(
        Coordinates $spawnCoords,
        Orientation $orientation,
        array $movCommands
    ): self {
        return new self($spawnCoords, $orientation, $movCommands);
    }
    
    public function getSpawnCoords(): Coordinates
    {
        return $this->spawnCoords;
    }
    
    public function getStartOrientation(): Orientation
    {
        return $this->startOrientation;
    }
    
    public function getMovCommands(): array
    {
        return $this->movCommands;
    }
}
