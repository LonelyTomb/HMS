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
        'username'=>'required|min:4|unique:Users.username',
        'password'=>'required|min:4',
        'surname'=>'required',
        'otherNames'=>'required|min:4',
        'email'=>'required|min:4',
        'phoneNumber'=>'required|min:4',
        'Address'=>'required|min:4'
    );
    if($validator->validate($_POST,$rules)){
        $username = Functions::escape($_POST['username']);
        $password = Functions::escape($_POST['password']);
        $surname = Functions::escape($_POST['surname']);
        $otherNames = Functions::escape($_POST['otherNames']);
        $email = Functions::escape($_POST['email']);
        $phoneNumber = Functions::escape($_POST['phoneNumber']);
        $address = Functions::escape($_POST['address']);
        $doctor = new Doctor($username,$password,$surname,$otherNames,$email,$phoneNumber,$address);
        $doctor->createPatient();
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
                    <h3 class="flow-text left-align ">CREATE PATIENT</h3>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="username" class="validate" name="username" value="<?php echo Input::catch('username');
?>" required>
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 input-field">
                            <input type="password" id="password" class="validate" name="password" required>
                            <label for="Password">Password</label>
                        </div>
                    </div>
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
                            <input type="text" id="address" class="validate" name="specialization" value="<?php echo Input::catch('address');
?>" required>
                            <label for="address">Address</label>
                        </div>
                    </div>
                    <button type="submit" class="btn waves-effect waves-ripple waves-teal waves-light enter pink l2">Enter</button>
                </form>
            </div>
        </div>
    </div>