<?php
declare(strict_types=1);

namespace MowersController\Domain\Service;

use MowersController\Domain\Model\GrassField\GrassField;
use MowersController\Domain\Model\Operations\BackwardOperation;
use MowersController\Domain\Model\Operations\ForwardOperation;
use MowersController\Domain\Model\Operations\TurnLeftOperation;
use MowersController\Domain\Model\Operations\TurnRightOperation;

final class RotateOrMoveMowerService
{
    private GrassField $grassField;
    private array $commands;
    
    public function moveWithAllOperations(GrassField $grassField, array $movementInstructions)
    {
        $this->grassField = $grassField;
        $this->initializeCommands();
    
        //$grassField->render();
        foreach ($movementInstructions as $movementInstruction) {
            $this->executeCommand($movementInstruction);
            //$grassField->render();
        }
    }
    
    public function executeCommand(string $letter): void
    {
        $this->commands[$letter]->execute();
    }
    
    private function initializeCommands()
    {
        $this->commands[TurnLeftOperation::OPERATION_LETTER] =
            TurnLeftOperation::create($this->grassField->getMowerEntityOnField());
        $this->commands[TurnRightOperation::OPERATION_LETTER] =
            TurnRightOperation::create($this->grassField->getMowerEntityOnField());
        $this->commands[ForwardOperation::OPERATION_LETTER] = ForwardOperation::create($this->grassField);
        $this->commands[BackwardOperation::OPERATION_LETTER] = BackwardOperation::create($this->grassField);
    }
}
