<?php

namespace StateMachine;

interface StateMachineInterface
{
    /**
     * @param array $allowedStates
     *
     * @return StateMachine
     */
    public function allowStates(array $allowedStates): self;

    /**
     * @param string $from
     * @param string $to
     *
     * @return StateMachine
     *
     * @throws Exception\StateNotAllowed
     */
    public function allowTransition(string $from, string $to): self;

    /**
     * @param string $from
     * @param string $to
     *
     * @return bool
     *
     * @throws Exception\StateNotAllowed
     */
    public function canTransit(string $from, string $to): bool;
}
