<?php
declare(strict_types=1);

namespace MowersController\Domain\Model\GrassField;

class GrassFieldSize
{
    private int $row;
    private int $column;
    
    public static function withLimitBounds(int $x, int $y): self
    {
        return new self($x, $y);
    }
    
    private function __construct(int $row, int $column)
    {
        $this->row = $row;
        $this->column = $column;
    }
    
    public function row(): int
    {
        return $this->row;
    }
    
    public function column():int
    {
        return $this->column;
    }
}
