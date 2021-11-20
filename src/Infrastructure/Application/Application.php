<?php
declare(strict_types=1);

namespace MowersController\Infrastructure\Application;

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    public function __construct(iterable $commands = [])
    {
        var_dump(count($commands));
        foreach ($commands as $command) {
            $this->add($command);
        }
        parent::__construct('MowersController');
    }
}
