<?php
declare(strict_types=1);

namespace MowersController\Domain\Model\GrassField;

use MowersController\Domain\Model\Coordinates\Coordinates;
use MowersController\Domain\Model\Entities\MowerEntity;
use MowersController\Domain\Model\Entities\VoidGridCellEntity;
use MowersController\Domain\Model\Operations\MoveOperations\MoveOperation;
use MowersController\Domain\Model\Orientation\OrientationOperation\BackwardOrientationOperation;
use MowersController\Domain\Model\Orientation\OrientationOperation\ForwardOrientationOperation;

class GrassField
{
    private array $grid;
    private Coordinates $mowerCoordinates;
    private Coordinates $mapSize;
    
    public static function createMapWithCoordinates(Coordinates $fieldSize): self
    {
        return new self($fieldSize);
    }
    
    public static function createMapWithCoordinatesAndResetGrid(Coordinates $fieldSize): self
    {
        $field = new self($fieldSize);
        $field->resetField();
        
        return $field;
    }
    
    private function __construct(Coordinates $fieldSize)
    {
        $this->mapSize = $fieldSize;
    }
    
    public function render()
    {
        foreach ($this->grid as $mapRow) {
            foreach ($mapRow as $cell) {
                echo $cell;
            }
            echo PHP_EOL;
        }
        echo '|-----------|';
        echo PHP_EOL;
    }
    
    public function getMowerCoordinates(): Coordinates
    {
        return $this->mowerCoordinates;
    }
    
    public function getMapSize(): Coordinates
    {
        return $this->mapSize;
    }
    
    public function getMowerEntityOnField(): MowerEntity
    {
        return $this->grid[$this->mowerCoordinates->row()][$this->mowerCoordinates->column()];
    }
    
    public function moveForward()
    {
        $operation = (ForwardOrientationOperation::create($this->getMowerEntityOnField()))->execute();
        $this->executeMovementOperation($operation);
    }
    
    public function moveBackward()
    {
        $operation = (BackwardOrientationOperation::create($this->getMowerEntityOnField()))->execute();
        $this->executeMovementOperation($operation);
    }
    
    public function executeMovementOperation(MoveOperation $moveOperation)
    {
        $coordinates                                                   = $moveOperation->execute($this);
        $oldCoordinates                                                = $this->mowerCoordinates;
        $this->grid[$coordinates->row()][$coordinates->column()]       = $this->getMowerEntityOnField();
        $this->grid[$oldCoordinates->row()][$oldCoordinates->column()] = VoidGridCellEntity::create();
        $this->mowerCoordinates                                        = $coordinates;
    }
    
    public function spawnMowerOnField(MowerEntity $mower, Coordinates $coords): void
    {
        $this->grid[$coords->row()][$coords->column()] = $mower;
        $this->mowerCoordinates                        = $coords;
    }
    
    public function resetField(): void
    {
        for($x = $this->getMapSize()->row(); $x >= 0; $x--) {
            for ($y = 0; $y <= $this->mapSize->column(); $y++) {
                $this->grid[$x][$y] = VoidGridCellEntity::create();
            }
        }
    }
}
