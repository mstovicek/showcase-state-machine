<?php

namespace UserAccount\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UserAccount\UserAccount\StateMachineInterface;

class Get extends Command
{
    /** @var StateMachineInterface */
    private $stateMachine;

    public function __construct(StateMachineInterface $stateMachine)
    {
        $this->stateMachine = $stateMachine;

        parent::__construct('get');
    }

    protected function configure()
    {
        $this->setDescription('Displays current state');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(
            sprintf(
                'Current state: %s',
                $this->stateMachine->getCurrentState()
            )
        );

        if ($this->stateMachine->isTerminalState()) {
            $output->writeln('This state is terminal.');
        }
    }
}
