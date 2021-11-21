<?php
declare(strict_types=1);

namespace MowersController\Application\Query\GetCalculatedMowerMovements;

class GetCalculatedMowerMovementsArrayDataTransformer implements GetCalculatedMowerMovementsDataTransformer
{
    public function transform($result)
    {
        $dataResult = [];
        
        foreach ($result as $mowerData) {
            $dataResult[] = $mowerData[0]->column()." ".$mowerData[0]->row()." ".$mowerData[1]->getLetter();
        }
        
        return $dataResult;
    }
}
