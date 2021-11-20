<?php
declare(strict_types=1);

namespace MowersController\UI\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MainProgramCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('mower:main')
            ->setDescription('Inits the application')
            ->setHelp('Inits the application with the steps that you need to control and spawns your mowers');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Testing project',
            '============',
            '',
        ]);
        $output->write('The project is running without problems, start programming!');
        $output->writeln('');
    
        return Command::SUCCESS;
    }
}
