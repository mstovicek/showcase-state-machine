<?php

namespace UserAccount\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UserAccount\Storage\StorageInterface;

class Reset extends Command
{
    /** @var StorageInterface */
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;

        parent::__construct('reset');
    }

    protected function configure()
    {
        $this->setDescription('Resets state to default');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->storage->reset();

        $output->writeln('State was reset to default');
    }
}
