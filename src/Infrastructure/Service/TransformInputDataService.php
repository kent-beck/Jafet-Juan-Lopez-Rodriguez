<?php
declare(strict_types=1);

namespace MowersController\Infrastructure\Service;

use MowersController\Domain\Model\Coordinates\Coordinates;
use MowersController\Domain\Model\FileData\InputData;
use MowersController\Domain\Model\FileData\MowerInputData;
use MowersController\Domain\Model\Operations\BackwardOperation;
use MowersController\Domain\Model\Operations\ForwardOperation;
use MowersController\Domain\Model\Operations\TurnLeftOperation;
use MowersController\Domain\Model\Operations\TurnRightOperation;
use MowersController\Domain\Model\Orientation\Orientation;
use MowersController\Domain\Model\Orientation\OrientationFactory;
use MowersController\Infrastructure\Exception\IncorrectInputFormatException;

class TransformInputDataService
{
    private Coordinates $fieldCoords;
    private array $mowersSpawnInfoAndMovements;
    
    /** @throws IncorrectInputFormatException */
    public function execute(string $data): InputData
    {
        $dataSplit = $this->splitStringIntoArray($data);
        $this->checkAndStoreIfCorrectFieldCoords($dataSplit[0]);
        $this->checkArrayStructureAndProcessIt($dataSplit);
        
        return InputData::createWithData($this->fieldCoords, $this->mowersSpawnInfoAndMovements);
    }
    
    /** @throws IncorrectInputFormatException */
    private function splitStringIntoArray(string $data): array
    {
        if (false === ($returnArray = preg_split("/\r\n|\n|\r/", $data))) {
            throw IncorrectInputFormatException::withNoLines();
        }
        
        return $returnArray;
    }
    
    /** @throws IncorrectInputFormatException */
    private function checkAndStoreIfCorrectFieldCoords(string $coordsString)
    {
        if (false === ($returnArray = preg_split('/ +/', $coordsString))) {
            throw IncorrectInputFormatException::withFieldCoords();
        }
        
        if (count($returnArray) > 2) {
            throw IncorrectInputFormatException::withFieldCoords();
        }
        
        $x = (int)$returnArray[0];
        $y = (int)$returnArray[1];
        
        if (false === is_numeric($x) || false === is_numeric($y)) {
            throw IncorrectInputFormatException::withFieldCoords();
        }
        
        $this->fieldCoords = Coordinates::createWithXAndY($x, $y);
    }
    
    /** @throws IncorrectInputFormatException */
    private function checkArrayStructureAndProcessIt(array $dataSplit): void
    {
        $copyData = $dataSplit;
        unset($copyData[0]);

        if (false === (count($copyData) % 2 === 0)) {
            throw IncorrectInputFormatException::withIncorrectPairInstructions();
        }
        
        $chunkArray = array_chunk($copyData, 2);
        
        foreach ($chunkArray as $mowerInstructions) {
            $this->checkSpawnCoordsAndRotationAndMovementActions($mowerInstructions);
        }
    }
    
    /** @throws IncorrectInputFormatException */
    private function checkSpawnCoordsAndRotationAndMovementActions(array $mowerInstructions): void
    {
        if (false === ($returnArray = preg_split('/ +/', $mowerInstructions[0]))) {
            throw IncorrectInputFormatException::withNoLines();
        }
    
        if (count($returnArray) !== 3) {
            throw IncorrectInputFormatException::withFieldCoords();
        }
        
        $this->checkNumericString($returnArray[0]);
        $this->checkNumericString($returnArray[1]);
        $this->checkOrientationString($returnArray[2]);
        
        $this->checkMovementActions($mowerInstructions[1]);
        
        $this->mowersSpawnInfoAndMovements[] = MowerInputData::createWithSpawnDataAndMovements(
            Coordinates::createWithXAndY((int)$returnArray[1], (int)$returnArray[0]),
            OrientationFactory::createInstance()->getOrientation($returnArray[2]),
            str_split($mowerInstructions[1])
        );
    }
    
    /** @throws IncorrectInputFormatException */
    private function checkMovementActions(string $moveActions): void
    {
        $movements = str_split($moveActions);
        foreach ($movements as $movement) {
            $this->checkMovementActionsString($movement);
        }
    }
    
    /** @throws IncorrectInputFormatException */
    private function checkNumericString(string $numericString): void
    {
        if (false === preg_match('(0|[1-9][0-9]*)', $numericString)
        ) {
            throw IncorrectInputFormatException::withNumericCoords();
        }
    }
    
    /** @throws IncorrectInputFormatException */
    private function checkOrientationString(string $orientation): void
    {
        if (false === preg_match('['
                .Orientation::ORIENTATION_SOUTH_LETTER
                .Orientation::ORIENTATION_NORTH_LETTER
                .Orientation::ORIENTATION_EAST_LETTER
                .Orientation::ORIENTATION_WEST_LETTER .']'
                , $orientation)
        ) {
            throw IncorrectInputFormatException::withOrientationLetter();
        }
    }
    
    /** @throws IncorrectInputFormatException */
    private function checkMovementActionsString(string $action): void
    {
        $movementsPermitted = [
            BackwardOperation::OPERATION_LETTER,
            ForwardOperation::OPERATION_LETTER,
            TurnLeftOperation::OPERATION_LETTER,
            TurnRightOperation::OPERATION_LETTER
        ];
        
        if (false === in_array($action, $movementsPermitted)){
            throw IncorrectInputFormatException::withMovementLetter();
        }
    }
}
