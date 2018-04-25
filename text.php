<?php

require_once 'vendor/autoload.php';

$db = \Nuntius\Nuntius::getDb();

// Create a random table.
if (!$db->getOperations()->tableExists('superheroes')) {
  $db->getOperations()->tableCreate('superheroes');
}

$objects = [
  ['name' => 'Tony', 'age' => 27, 'alterego' => 'Iron Man'],
  ['name' => 'Peter', 'age' => 20, 'alterego' => 'SpiderMan'],
  ['name' => 'Steve', 'age' => 18, 'alterego' => 'Captain America'],
];


\Kint::dump($db->getStorage()->table('superheroes')->load('5ae0cc7cf3dd2b8baf1c53e4'));
