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
$ cd exemples/user-account

# install dependencies, incl. mstovicek/state-machine
$ composer install

# get current state
$ php index.php get

# set state
$ php index.php set <state>

# reset state to default
$ php index.php reset

```
