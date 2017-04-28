<?php

require_once 'vendor/autoload.php';

$container = \Nuntius\Nuntius::container();

$foo = \Nuntius\Nuntius::getCronTasksManager();
Kint::dump($foo->getCronTask('log')->getPeriod());
