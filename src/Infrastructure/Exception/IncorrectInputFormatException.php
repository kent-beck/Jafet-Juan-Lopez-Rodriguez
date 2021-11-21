<?php
declare(strict_types=1);

namespace MowersController\Infrastructure\Exception;

use Exception;

class IncorrectInputFormatException extends Exception
{
    public static function withNoLines(): self
    {
        return new self('Error on format, this must require some break lines');
    }
    
    public static function withFieldCoords(): self
    {
        return new self('Error on format, the first line requires two digits divided by a space');
    }
    
    public static function withIncorrectPairInstructions(): self
    {
        return new self('Error on format, write start coords and orientation in one line and movement commands in another');
    }
    
    public static function withNumericCoords(): self
    {
        return new self('Error on format, the Coordinates must be numeric');
    }
    
    public static function withOrientationLetter(): self
    {
        return new self('Error on format, the orientation must be one of [N,S,E,W]');
    }
    
    public static function withMovementLetter(): self
    {
        return new self('Error on format, the movement actions must be one of each [L,R,M,B]');
    }
}
