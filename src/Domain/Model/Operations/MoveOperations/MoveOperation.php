<?php
namespace MowersController\Domain\Model\Operations\MoveOperations;

use MowersController\Domain\Model\Coordinates\Coordinates;
use MowersController\Domain\Model\GrassField\GrassField;

abstract class MoveOperation
{
    protected abstract function changedRow(): int;
    protected abstract function changedColumn(): int;

    public function execute(GrassField $field): Coordinates
    {
        $coordinate = $field->getMowerCoordinates();
        return $this->returnValidCoordinate(
            $field,
            Coordinates::createWithXAndY(
                $coordinate->row()+$this->changedRow(),
                $coordinate->column()+$this->changedColumn()
            )
        );
    }

    private function  returnValidCoordinate(GrassField $field, Coordinates $coordinates): Coordinates
    {
        $row = min($field->getMapSize()->row(), $coordinates->row());
        $row = max(0, $row);

        $column = min($field->getMapSize()->column(), $coordinates->column());
        $column = max(0, $column);

        return Coordinates::createWithXAndY($row, $column);
    }
}
