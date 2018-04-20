<?php

require_once 'vendor/autoload.php';

$db = \Nuntius\Nuntius::getDb();

$db->getOperations()->dbDrop('foo');