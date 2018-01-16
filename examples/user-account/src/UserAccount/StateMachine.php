<?php

namespace UserAccount\UserAccount;

use StateMachine\Exception\StateNotAllowed;
use UserAccount\Storage\StorageInterface;

class StateMachine implements StateMachineInterface
{
    const STATE_NEW = 'new';
    const STATE_ACTIVE = 'active';
    const STATE_LIMITED = 'limited';
    const STATE_OUTDATED = 'outdated';
    const STATE_REMOVED = 'removed';

    /** @var \StateMachine\StateMachine */
    private $stateMachine;

    /** @var string */
    private $currentState;
    /** @var StorageInterface */
    private $storage;

    /**
     * @throws \Exception
     */
    public function __construct(
        \StateMachine\StateMachineInterface $stateMachine,
        StorageInterface $storage
    ) {
        $this->stateMachine = $stateMachine;
        $this->storage = $storage;

        $this->stateMachine->allowStates([
            static::STATE_NEW,
            static::STATE_LIMITED,
            static::STATE_ACTIVE,
            static::STATE_OUTDATED,
            static::STATE_REMOVED,
        ]);

        try {
            $this->stateMachine->allowTransition(static::STATE_NEW, static::STATE_LIMITED);
            $this->stateMachine->allowTransition(static::STATE_NEW, static::STATE_ACTIVE);
            $this->stateMachine->allowTransition(static::STATE_ACTIVE, static::STATE_OUTDATED);
            $this->stateMachine->allowTransition(static::STATE_OUTDATED, static::STATE_ACTIVE);
            $this->stateMachine->allowTransition(static::STATE_OUTDATED, static::STATE_REMOVED);
        } catch (StateNotAllowed $e) {
            throw new \Exception('Cannot configure transitions: ' . $e->getMessage());
        }

        $this->currentState = $this->storage->get() ?: static::STATE_NEW;
    }

    public function getCurrentState(): string
    {
        return $this->currentState;
    }

    public function isTerminalState(): bool
    {
        return $this->currentState === static::STATE_REMOVED;
    }

    /**
     * @throws \RuntimeException
     */
    public function setState(string $state)
    {
        if (!$this->stateMachine->canTransit($this->currentState, $state)) {
            throw new \RuntimeException(
                sprintf(
                    'cannot set state to: %s',
                    $state
                )
            );
        }

        $this->currentState = $state;

        $this->storeCurrentState();
    }

    private function storeCurrentState()
    {
        $this->storage->set($this->currentState);
    }
}
