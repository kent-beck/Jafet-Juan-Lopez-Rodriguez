<?php
declare(strict_types=1);

namespace MowersController\Domain\Model\FileData;

use MowersController\Domain\Model\Coordinates\Coordinates;

class InputData
{
    private Coordinates $fieldCoords;
    private array $mowersInputData;
    
    private function __construct(
        Coordinates $fieldCoords,
        array $mowersInputData
    ) {
        $this->fieldCoords = $fieldCoords;
        $this->mowersInputData = $mowersInputData;
    }
    
    public static function createWithData(
        Coordinates $fieldCoords,
        array $mowersInputData
    ): self {
        return new self($fieldCoords, $mowersInputData);
    }
    
    public function getFieldCoords(): Coordinates
    {
        return $this->fieldCoords;
    }
    
    public function getMowersInputData(): array
    {
        return $this->mowersInputData;
    }
}
