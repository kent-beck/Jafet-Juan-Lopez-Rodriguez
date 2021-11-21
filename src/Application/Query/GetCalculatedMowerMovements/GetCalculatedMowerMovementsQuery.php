<?php
declare(strict_types=1);

namespace MowersController\Application\Query\GetCalculatedMowerMovements;

final class GetCalculatedMowerMovementsQuery
{
    public static function create(): self
    {
        return new self();
    }
}
