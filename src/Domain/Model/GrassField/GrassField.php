<?php
declare(strict_types=1);

namespace MowersController\Domain\Model\GrassField;

use MowersController\Domain\Model\Coordinates\Coordinates;
use MowersController\Domain\Model\Entities\MowerEntity;
use MowersController\Domain\Model\Entities\VoidGridCellEntity;

class GrassField
{
    private array $grid;
    private Coordinates $mowerCoordinates;
    private GrassFieldSize $mapSize;
    
    private function __construct(GrassFieldSize $fieldSize)
    {
        $this->mapSize = $fieldSize;
        for ($x = 0; $x < $fieldSize->row(); $x++) {
            for ($y = 0; $y < $fieldSize->column(); $y++) {
                $this->grid[$x][$y] = VoidGridCellEntity::create();
            }
        }
        /* sacar fuera en el servicio de spawn del cortacesped */
        $this->grid[2][2]       = ElementsFactory::createInstance()->getShipElement();
        $this->mowerCoordinates = new Coordinates(2, 2);
    }
    
    public static function createMapWithCoordinates(GrassFieldSize $fieldSize): self
    {
        return new self($fieldSize);
    }
    
    public function render()
    {
        foreach ($this->grid as $mapRow) {
            foreach ($mapRow as $cell) {
                echo $cell;
            }
            echo PHP_EOL;
        }
    }
    
    public function MowerCoordinates(): Coordinates
    {
        return $this->mowerCoordinates;
    }
    
    public function getMapSize(): GrassFieldSize
    {
        return $this->mapSize;
    }
    
    public function getMowerEntityOnField(): MowerEntity
    {
        return $this->grid[$this->mowerCoordinates->row()][$this->mowerCoordinates->column()];
    }
    
    public function moveForward()
    {
        $operation = (new ForwardOperation($this->getMowerEntityOnField()))->execute();
        $this->executeMovementOperation($operation);
    }
    
    public function moveBackward()
    {
        $operation = (new BackwardOperation($this->getMowerEntityOnField()))->execute();
        $this->executeMovementOperation($operation);
    }
    
    public function executeMovementOperation(MoveOperation $operation)
    {
        $coordinates                                                  = $operation->execute($this);
        $oldCoordinates                                               = $this->mowerCoordinates;
        $this->grid[$coordinates->row()][$coordinates->column()]       = $this->getMower();
        $this->grid[$oldCoordinates->row()][$oldCoordinates->column()] = ElementsFactory::createInstance()->getVoidElement();
        $this->mowerCoordinates                                       = $coordinates;
    }
}
