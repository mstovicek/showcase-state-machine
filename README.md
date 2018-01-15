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

...


## Developer usage

### Install dependencies

```
$ composer install
```

### Run tests

```
$ composer tests
```

### Run examples

```
$ php examples/statuses/index.php
$ php examples/pull-request/index.php
```
