<?php
namespace HMS;
require "vendor/autoload.php";

use HMS\Database\Database;
use HMS\Processor\Jasonify;
use HMS\Processor\{User,Time,Input};


$a = new User('name','test','a');
// var_dump($a);
// echo($a->getA());
// $a->test();
try{

// echo Jasonify::toJson($a->db->select("patients","*"));
}catch(PDOException $e){
    echo $e->getMessage();
}
echo Time::setDateTime(null,'y');
// $a->insert('Users',['name'=>'Victory']);
if(Input::exists()){
   echo Jasonify::toJson($_POST);
}

?>
<form method="post">
    
<div class="input-field col s12">
                            <p>Days Available</p>
                            <p>
                                <input type="checkbox" id="sunday" class="validate filled-in" name="daysAvailable[]"  value="Sunday">
                                <label for="sunday">Sunday</label>
                            </p>
                            <p>
                                <input type="checkbox" id="monday" class="validate filled-in" name="daysAvailable[]"  value="Monday">
                                <label for="monday">Monday</label>
                            </p>
                            <p>
                                <input type="checkbox" id="tuesday" class="validate filled-in" name="daysAvailable[]"  value="Tuesday">
                                <label for="tuesday">Tuesday</label>
                            </p>
                            <p>
                                <input type="checkbox" id="wednesday" class="validate filled-in" name="daysAvailable[]"  value="Wednesday">
                                <label for="wednesday">Wednesday</label>
                            </p>
                            <p>
                                <input type="checkbox" id="thursday" class="validate filled-in" name="daysAvailable[]"  value="Thursday">
                                <label for="thursday">Thursday</label>
                            </p>
                            <p>
                                <input type="checkbox" id="friday" class="validate filled-in" name="daysAvailable[]"  value="Friday">
                                <label for="friday">Friday</label>
                            </p>
                            <p>
                                <input type="checkbox" id="saturday" class="validate filled-in" name="daysAvailable[]"  value="Saturday">
                                <label for="saturday">Saturday</label>
                            </p>
                        </div>
                        <input type="submit" value="Send">
</form>
                        