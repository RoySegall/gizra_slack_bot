<?php

$autoloader = require_once 'vendor/autoload.php';
$container = \Nuntius\Nuntius::container($autoloader);

return $autoloader;
