<?php

namespace UserAccount\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UserAccount\UserAccount\StateMachineInterface;

class Set extends Command
{
    /** @var StateMachineInterface */
    private $stateMachine;

    public function __construct(StateMachineInterface $stateMachine)
    {
        $this->stateMachine = $stateMachine;

        parent::__construct('set');
    }

    protected function configure()
    {
        $this->setDescription('Sets state')
            ->addArgument('state', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $state = $input->getArgument('state');

        if ($state === null) {
            $output->writeln('State cannot be empty!');

            return;
        }

        try {
            $this->stateMachine->setState($state);
            $output->writeln(
                sprintf(
                    'State was set to: %s',
                    $state
                )
            );
        } catch (\Exception $e) {
            $output->writeln(
                sprintf(
                    'Cannot set state to %s! Check current state and allowed transitions.',
                    $state
                )
            );
        }
    }
}
