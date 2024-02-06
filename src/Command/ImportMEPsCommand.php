<?php

namespace App\Command;

use App\Service\MEPImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'ImportMEPsCommand',
    description: 'Import EU Parliament members from external XML source',
)]
class ImportMEPsCommand extends Command
{
    private $mepImporter;

    public function __construct(MEPImporter $mepImporter)
    {
        $this->mepImporter = $mepImporter;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:import-meps')
            ->setDescription('Import MEPs from the European Parliament source');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->mepImporter->importMEPs();

        $output->writeln('MEPs imported successfully.');

        return Command::SUCCESS;
    }
}
