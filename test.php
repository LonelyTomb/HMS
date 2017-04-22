<?php
namespace HMS;
require "vendor/autoload.php";

use HMS\Database\Database;
use HMS\Processor\Jasonify;
use HMS\Processor\User;


$a = new User();
// var_dump($a);
echo($a->getA());
try{

// echo Jasonify::toJson($a->db->select("patients","*"));
}catch(PDOException $e){
    echo $e->getMessage();
}
// $a->insert('Users',['name'=>'Victory']);
