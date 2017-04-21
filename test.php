<?php

require __DIR__."/vendor/autoload.php";

use HMS\Database\Database;
use HMS\Modules\Jasonify;

$a = new Database();
try{

echo Jasonify::toJson($a->database->select("Users","*"));
}catch(PDOException $e){
    echo $e->getMessage();
}
// $a->insert('Users',['name'=>'Victory']);
