<?php
require_once(__DIR__ . '/../vendor/autoload.php');

use Symfony\Component\Console\Application;
use MowersController\UI\Console\MainProgramCommand;

$application = new Application();
$application->addCommands([new MainProgramCommand()]);
$application->run();