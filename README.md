## Objection

Create a library which will be validating transitions between states and implement the following graph of advert
states using it:

```
               ,---------.
      |------> | Limited |
      |        `---------'
      |            |
      |            ˅
   ,-----.     ,--------.     ,----------.     ,---------.
   | New | --> | Active | --> | Outdated | --> | Removed |
   `-----'     `--------'     `----------'     `---------'
                   ˄               |
                   |---------------|
```

**Package is for demonstration purpose only!**


## Usage

### Install as a project dependency

```
$ composer require mstovicek/state-machine
```

### Classes and methods

`\StateMachine\StateMachine` implements `\StateMachine\StateMachineInterface` with following methods:
- `allowStates` - accepts array of allowed states as an only parameter, transitions are allowed only for such states
- `allowTransition` - accepts 2 parameters - `from` and `to` - and registers a transition between them
- `canTransit` - accepts 2 parameters - `from` and `to` and return boolean `true` if such transition is allowed, `false` otherwise


## Developer usage

### Install dependencies

```
$ composer install
```

### Run tests

```
$ composer tests
```

### Run example

```
$ cd examples/user-account

# install dependencies, incl. mstovicek/state-machine
$ composer install

# get current state
$ php index.php get

# set state
$ php index.php set <state>

# reset state to default
$ php index.php reset
```

### Example output:

```
$ php index.php get
Current state: new

$ php index.php set active
State was set to: active

$ php index.php get
Current state: active

$ php index.php set outdated
State was set to: outdated

$ php index.php get
Current state: outdated

$ php index.php set limited
Cannot set state to limited! Check current state and allowed transitions.

$ php index.php get
Current state: outdated

$ php index.php set removed
State was set to: removed

$ php index.php get
Current state: removed
This state is terminal.

$ php index.php set active
Cannot set state to active! Check current state and allowed transitions.

$ php index.php reset
State was reset to default

$ php index.php get
Current state: new
```
