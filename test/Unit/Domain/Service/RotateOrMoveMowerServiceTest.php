<?php
declare(strict_types=1);

namespace MowersController\Unit\Domain\Service;

use MowersController\Domain\Exceptions\RotateOrMoveMower\IncorrectCommandOperationException;
use MowersController\Domain\Model\Coordinates\Coordinates;
use MowersController\Domain\Model\Entities\MowerEntity;
use MowersController\Domain\Model\GrassField\GrassField;
use MowersController\Domain\Model\Orientation\South;
use MowersController\Domain\Service\RotateOrMoveMowerService;
use PHPUnit\Framework\TestCase;

class RotateOrMoveMowerServiceTest extends TestCase
{
    private RotateOrMoveMowerService $testClass;
    
    protected function setUp(): void
    {
        $this->testClass = $this->getTestClass();
    }
    
    /** @test */
    public function given_field_when_execute_program_then_return_the_correct_result(): void
    {
        $grassField = GrassField::createMapWithCoordinates(Coordinates::createWithXAndY(6,6));
        $mower = MowerEntity::createWithOrientation(South::create());
        $mowerCoords = Coordinates::createWithXAndY(1,1);
        $grassField->spawnMowerOnField($mower, $mowerCoords);
        $movements = ['M'];
        
        $this->testClass->moveWithAllOperations($grassField, $movements);

        $this->assertSame($grassField->getMowerCoordinates()->row(), 0);
        $this->assertSame($grassField->getMowerCoordinates()->column(), 1);
    }
    
    /** @test */
    public function given_non_exist_command_operation_when_run_program_then_throw_incorrect_command_exception(): void
    {
        $grassField = GrassField::createMapWithCoordinates(Coordinates::createWithXAndY(6,6));
        $mower = MowerEntity::createWithOrientation(South::create());
        $mowerCoords = Coordinates::createWithXAndY(3,2);
        $grassField->spawnMowerOnField($mower, $mowerCoords);
        $movements = ['X'];
        
        $this->expectException(IncorrectCommandOperationException::class);
        
        $this->testClass->moveWithAllOperations($grassField, $movements);
    }
    
    private function getTestClass(): RotateOrMoveMowerService
    {
        return new RotateOrMoveMowerService();
    }
}
