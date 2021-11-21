<?php

namespace MowersController\Domain\Model\FileData;

interface FileDataRepositoryInterface
{
    public function addData(int $result): void;
    public function getData(int $result): array;
}