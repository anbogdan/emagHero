<?php

use EmagHero\MyLogger;
require_once realpath('vendor/autoload.php');

$logger = MyLogger::getInstance();

$fight = new EmagHero\Fight(20, $logger);
$fight->start();
