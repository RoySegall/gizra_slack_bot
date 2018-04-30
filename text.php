<?php

require_once 'vendor/autoload.php';

$db = \Nuntius\Nuntius::getDb();

//// Create a random table.
//if (!$db->getOperations()->tableExists('superheroes')) {
//  $db->getOperations()->tableCreate('superheroes');
//}
//
//$objects = [
//  ['name' => 'Tony', 'age' => 27, 'alterego' => 'Iron Man'],
//  ['name' => 'Peter', 'age' => 20, 'alterego' => 'SpiderMan'],
//  ['name' => 'Steve', 'age' => 18, 'alterego' => 'Captain America'],
//];

//$db->getOperations()->tableCreate('superheroes');
//$db->getOperations()->tableDrop('superheroes');

//$id = '5ae5f2d2f3dd2b68fc5929a2';
$id = substr(md5('foo'), 0, 24);
\Kint::dump(($id));
\Kint::dump(new \MongoDB\BSON\ObjectId($id));

