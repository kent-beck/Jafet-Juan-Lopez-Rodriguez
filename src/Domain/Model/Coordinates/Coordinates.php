<?php

namespace MowersController\Domain\Model\Coordinates;

class Coordinates
{
    private int $row;
    private int $column;
    
    public static function createWithXAndY(int $x, int $y): self
    {
        return new self($x, $y);
    }
    
    private function __construct($row, $column)
    {
        $this->row = $row;
        $this->column = $column;
    }
    
    public function row(): int
    {
        return $this->row;
    }
    
    public function column(): int
    {
        return $this->column;
    }

    public function equals(Coordinates $coordinates): bool
    {
        return $this->row() === $coordinates->row()
            && $this->column() === $coordinates->column();
    }
}
