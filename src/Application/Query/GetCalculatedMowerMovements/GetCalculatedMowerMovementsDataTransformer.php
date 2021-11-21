<?php

namespace MowersController\Application\Query\GetCalculatedMowerMovements;

interface GetCalculatedMowerMovementsDataTransformer
{
    public function transform($result);
}