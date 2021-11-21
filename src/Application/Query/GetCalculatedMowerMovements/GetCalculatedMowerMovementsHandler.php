<?php
declare(strict_types=1);

namespace MowersController\Application\Query\GetCalculatedMowerMovements;

use MowersController\Domain\Model\Entities\MowerEntity;
use MowersController\Domain\Model\FileData\FileDataRepositoryInterface;
use MowersController\Domain\Model\FileData\MowerInputData;
use MowersController\Domain\Service\CreateFieldService;
use MowersController\Domain\Service\RotateOrMoveMowerService;

final class GetCalculatedMowerMovementsHandler
{
    private FileDataRepositoryInterface $fileRepository;
    private CreateFieldService $createFieldService;
    private RotateOrMoveMowerService $rotateOrMoveMowerService;
    private GetCalculatedMowerMovementsDataTransformer $dataTransformer;
    
    public function __construct(
        FileDataRepositoryInterface $fileRepository,
        CreateFieldService $createFieldService,
        RotateOrMoveMowerService $rotateOrMoveMowerService,
        GetCalculatedMowerMovementsDataTransformer $dataTransformer
    ) {
        $this->fileRepository           = $fileRepository;
        $this->createFieldService       = $createFieldService;
        $this->rotateOrMoveMowerService = $rotateOrMoveMowerService;
        $this->dataTransformer          = $dataTransformer;
    }
    
    public function handle(GetCalculatedMowerMovementsQuery $query): array
    {
        $result = [];
        $inputData = $this->fileRepository->getData();
        $grassField = $this->createFieldService->execute($inputData->getFieldCoords());
        
        /** @var MowerInputData $mowersInputData */
        foreach ($inputData->getMowersInputData() as $mowersInputData) {
            $grassField->resetField();
            $grassField->spawnMowerOnField(
                MowerEntity::createWithOrientation($mowersInputData->getStartOrientation()),
                $mowersInputData->getSpawnCoords()
            );
            
            $this->rotateOrMoveMowerService->moveWithAllOperations(
                $grassField,
                $mowersInputData->getMovCommands()
            );
            
            $result[] = [
                $grassField->getMowerCoordinates(),
                $grassField->getMowerEntityOnField()->getOrientation()
            ];
        }

        return $this->dataTransformer->transform($result);
    }
}
