<?php

namespace MowersController\Domain\Model\FileData;

interface FileDataRepositoryInterface
{
    public function addData(string $result): void;
    public function getData(): InputData;
}