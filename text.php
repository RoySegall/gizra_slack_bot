<?php

$autoloader = require_once 'vendor/autoload.php';
$container = \Nuntius\Nuntius::container($autoloader);
$group_control = new DiscoveryOne\GroundControl();

Kint::dump($group_control->eagleLand());
Kint::dump($container->get('ground_control')->liftOff());