<?php
require __DIR__ . './../vendor/autoload.php';
// SESSION
session_start();
//$store = new App\Storage\SessionStorage;
// FILES
//$store = new App\Storage\FileStorage;
// DATABASE (MYSQL)
$store = new App\Storage\DatabaseStorage;


$store->set('name', 'Clement');
//$store->set('lllll', 'jjjjjj');
//$store->delete('name');
//$store->destroy();
//echo $store->get('age') ;
var_dump($store->all());

