<?php
declare(strict_types=1);

namespace MowersController\Infrastructure\Repository;

use MowersController\Domain\Model\FileData\FileDataRepositoryInterface;
use MowersController\Domain\Model\FileData\InputData;
use MowersController\Infrastructure\Service\TransformInputDataService;

class FileDataRepository implements FileDataRepositoryInterface
{
    private const DATA_DIRECTORY = 'data/';
    private const DIRECTORY_LEVEL = __DIR__.'/../../../';
    private string $file;
    private string $data;
    private TransformInputDataService $inputDataService;
    
    public function __construct(string $file, TransformInputDataService $inputDataService)
    {
        $file = self::DIRECTORY_LEVEL.self::DATA_DIRECTORY.$file;
        $data = file_get_contents($file);
        $this->file = $file;
        $this->data = empty($data) ? [] : $data;
        $this->inputDataService = $inputDataService;
    }
    
    public function addData(string $result): void
    {
        $this->data = $result;
        file_put_contents($this->file, $this->data);
    }
    
    public function getData(): InputData
    {
        return $this->inputDataService->execute($this->data);
    }
}