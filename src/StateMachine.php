<?php

namespace StateMachine;

class StateMachine implements StateMachineInterface
{
    /** @var array */
    private $allowedStates = [];

    /** @var array */
    private $allowedTransitions = [];

    /**
     * @param array $allowedStates
     *
     * @return StateMachine
     */
    public function allowStates(array $allowedStates): StateMachineInterface
    {
        $this->allowedStates = $allowedStates;

        return $this;
    }

    /**
     * @param string $from
     * @param string $to
     *
     * @return StateMachine
     *
     * @throws Exception\StateNotAllowed
     */
    public function allowTransition(string $from, string $to): StateMachineInterface
    {
        $this->assertAllowedState($from);
        $this->assertAllowedState($to);

        if (!isset($this->allowedTransitions[$from])) {
            $this->allowedTransitions[$from] = [];
        }

        $this->allowedTransitions[$from][$to] = true;

        return $this;
    }

    /**
     * @param string $from
     * @param string $to
     *
     * @return bool
     *
     * @throws Exception\StateNotAllowed
     */
    public function canTransit(string $from, string $to): bool
    {
        $this->assertAllowedState($from);
        $this->assertAllowedState($to);

        if (!isset($this->allowedTransitions[$from])) {
            return false;
        }

        return isset($this->allowedTransitions[$from][$to]);
    }

    /**
     * @param string $state
     *
     * @throws Exception\StateNotAllowed
     */
    private function assertAllowedState(string $state)
    {
        if (!$this->isAllowedState($state)) {
            throw new Exception\StateNotAllowed(
                sprintf('State "%s" is not allowed', $state)
            );
        }
    }

    private function isAllowedState(string $state): bool
    {
        return in_array($state, $this->allowedStates);
    }
}
