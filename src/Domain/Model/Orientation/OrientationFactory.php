<?php

namespace MowersController\Domain\Model\Orientation;

class OrientationFactory
{
    private static ?self $instance = null;
    private array $orientation = [];

    private function __construct()
    {
        $this->orientation[Orientation::ORIENTATION_SOUTH_LETTER] = South::create();
        $this->orientation[Orientation::ORIENTATION_NORTH_LETTER] = North::create();
        $this->orientation[Orientation::ORIENTATION_EAST_LETTER] = East::create();
        $this->orientation[Orientation::ORIENTATION_WEST_LETTER] = West::create();
    }

    public static function createInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getOrientation(string $nameOrientation): Orientation
    {
        return $this->orientation[$nameOrientation];
    }
}
