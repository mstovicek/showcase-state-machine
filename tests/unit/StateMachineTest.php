<?php

namespace StateMachine\Tests\Unit;

use PHPUnit\Framework\TestCase;
use StateMachine\Exception\StateNotAllowed;
use StateMachine\StateMachine;

class StateMachineTest extends TestCase
{
    public function testAllowStates()
    {
        $stateMachine = new StateMachine();

        try {
            $this->assertFalse(
                $stateMachine->canTransit('a', 'b')
            );
            $this->fail('Transition between not allowed states should throw exception');
        } catch (StateNotAllowed $e) {
            // ok
        }

        $stateMachine->allowStates(['a', 'b']);

        $this->assertFalse(
            $stateMachine->canTransit('a', 'b')
        );
    }

    public function testAllowTransitionCanTransit()
    {
        $stateMachine = new StateMachine();
        $stateMachine->allowStates(['a', 'b', 'c']);

        $this->assertFalse($stateMachine->canTransit('a', 'b'));
        $this->assertFalse($stateMachine->canTransit('b', 'c'));
        $this->assertFalse($stateMachine->canTransit('c', 'a'));

        $stateMachine->allowTransition('a', 'b')
            ->allowTransition('b', 'c');

        $this->assertTrue($stateMachine->canTransit('a', 'b'));
        $this->assertTrue($stateMachine->canTransit('b', 'c'));
        $this->assertFalse($stateMachine->canTransit('c', 'a'));
    }

    public function testAllowTransitionThrowsStateNotAllowedException()
    {
        $this->expectException(StateNotAllowed::class);
        $this->expectExceptionMessage('State "b" is not allowed');

        $stateMachine = new StateMachine();
        $stateMachine->allowStates(['a']);
        $stateMachine->allowTransition('a', 'b');
    }

    public function testCanTransitThrowsStateNotAllowedException()
    {
        $this->expectException(StateNotAllowed::class);
        $this->expectExceptionMessage('State "b" is not allowed');

        $stateMachine = new StateMachine();
        $stateMachine->allowStates(['a']);
        $stateMachine->canTransit('a', 'b');
    }
}
