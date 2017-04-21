<?php

require "vendor/autoload.php";

use HMS\Database\Database;
use HMS\Processor\Jasonify;

$a = new Database();
try{

echo Jasonify::toJson($a->database->select("Users","*"));
}catch(PDOException $e){
    echo $e->getMessage();
}
// $a->insert('Users',['name'=>'Victory']);
