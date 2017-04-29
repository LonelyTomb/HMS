<?php
namespace HMS\Forms\patient;

use HMS\Processor\{
	Input,Validator,Functions
};
use HMS\Modules\Patient\Patient;
;

if(Input::exists()){
	$validator = new Validator();
    $rules = array(
        'surname'=>'required',
        'otherNames'=>'required|min:4',
        'email'=>'required|min:4|unique:patients.email',
        'phoneNumber'=>'required',
        'address'=>'required|min:4'
    );
    if($validator->validate($_POST,$rules)){
        $surname = Functions::escape($_POST['surname']);
        $otherNames = Functions::escape($_POST['otherNames']);
        $email = Functions::escape($_POST['email']);
        $phoneNumber = Functions::escape($_POST['phoneNumber']);
        $address = Functions::escape($_POST['address']);
        $patient = new Patient($surname,$otherNames,$address,$phoneNumber,$email);
        $patient->createPatient();
    }else{
        $error = $validator->getErrors();
        var_dump($error);

    }
}


?>
    <div class="container">
        <div class="card z-depth-3">
            <div class="card-content">
                <form action="" class="" method="POST">
                    <h3 class="flow-text left-align">CREATE PATIENT</h3>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="surname" class="validate" name="surname" value="<?php echo Input::catch('surname');
?>" required>
                            <label for="surname">Surname</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="otherNames" class="validate" name="otherNames" value="<?php echo Input::catch('otherNames');
?>" required>
                            <label for="otherNames">Other Names</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="email" class="validate" name="email" value="<?php echo Input::catch('email');
?>" required>
                            <label for="email">E-Mail</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="phoneNumber" class="validate" name="phoneNumber" value="<?php echo Input::catch('phoneNumber');
?>" required>
                            <label for="phoneNumber">Phone Number</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea rows="" cols="" id="address" class="validate materialize-textarea" name="address" value="<?php echo Input::catch('address');
?>" required></textarea>
                            <label for="address">Address</label>
                        </div>
                    </div>
                    <button type="submit" class="btn waves-effect waves-ripple waves-teal waves-light enter pink l2">Enter</button>
                </form>
            </div>
        </div>
    </div>