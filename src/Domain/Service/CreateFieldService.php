<?php
declare(strict_types=1);

namespace MowersController\Domain\Service;

use MowersController\Domain\Model\Coordinates\Coordinates;
use MowersController\Domain\Model\GrassField\GrassField;

final class CreateFieldService
{
    public function execute(Coordinates $fieldSize): GrassField
    {
        return GrassField::createMapWithCoordinates($fieldSize);
    }
}
