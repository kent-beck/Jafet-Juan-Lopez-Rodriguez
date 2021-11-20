<?php
declare(strict_types=1);

namespace MowersController\UI\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MainProgramCommand extends Command
{
    public const NAME = 'mower:main';
    
    protected function configure()
    {
        $this
            ->setName(self::NAME)
            ->setDescription('Inits the application')
            ->setHelp('Inits the application loading the instructions on the file data for control your mowers');
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
