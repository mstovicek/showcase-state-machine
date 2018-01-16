<?php

namespace UserAccount\UserAccount;

interface StateMachineInterface
{
    public function getCurrentState(): string;

    public function isTerminalState(): bool;

    public function setState(string $state);
}
