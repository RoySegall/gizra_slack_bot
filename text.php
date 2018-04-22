<?php

require_once 'vendor/autoload.php';

$db = \Nuntius\Nuntius::getDb();

//$db->getOperations()->tableCreate('users');
//\Kint::dump($db->getOperations()->tableExists('users'));
//\Kint::dump($db->getOperations()->tableExists('noy'));
$db->getOperations()->indexCreate('noy', ['name' => 13]);
$db->getOperations()->indexDrop('noy', 'name_13');
\Kint::dump($db->getOperations()->indexExists('noy', 'name_1'));
