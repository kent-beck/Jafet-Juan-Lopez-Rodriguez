<?php
declare(strict_types=1);

namespace MowersController\Domain\Exceptions\RotateOrMoveMower;

use Exception;

class IncorrectCommandOperationException extends Exception
{
    public static function withCommand(string $letter): self
    {
        return new self("Error with the command: {$letter} is incorrect");
    }
}
