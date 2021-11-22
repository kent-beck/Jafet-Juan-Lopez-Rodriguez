<?php
declare(strict_types=1);

namespace MowersController\Domain\Exceptions\MoveOperation;

use Exception;

class MowerOutOfBoundsException extends Exception
{
    public static function withCoordinates(int $xCoord, int $yCoord): self
    {
        return new self("Error on Move: Warning! you can lose your mower on the streets if you rebase the field size. Incorrect coordinates: {$xCoord} - {$yCoord}");
    }
}
