<?php
declare(strict_types=1);

namespace MowersController\UI\Console;

use MowersController\Application\Query\GetCalculatedMowerMovements\GetCalculatedMowerMovementsHandler;
use MowersController\Application\Query\GetCalculatedMowerMovements\GetCalculatedMowerMovementsQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MainProgramCommand extends Command
{
    public const NAME = 'mower:main';
    private GetCalculatedMowerMovementsHandler $handler;
    
    public function __construct(GetCalculatedMowerMovementsHandler $handler)
    {
        parent::__construct();
        $this->handler = $handler;
    }
    
    protected function configure()
    {
        $this
            ->setName(self::NAME)
            ->setDescription('Inits the application')
            ->setHelp('Inits the application loading the instructions on the file data for control your mowers');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Mower Controller',
            '================',
            '',
        ]);
        $output->writeln('Reading the file and show the results:');
        
        $response = $this->handler->handle(GetCalculatedMowerMovementsQuery::create());
    
        foreach ($response as $line) {
            $output->writeln($line);
        }
        
        return Command::SUCCESS;
    }
}
