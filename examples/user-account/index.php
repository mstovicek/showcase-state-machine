#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

$application = new UserAccount\Application();

$application->run();
