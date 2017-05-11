<?php
namespace HMS\Forms\patient;

use HMS\Processor\{
	Input, Validator, Functions, Errors
};
use HMS\Modules\Patient\Patient;

;

if (Input::exists()) {
	$validator = new Validator();
	$rules = [
		'surname' => 'required',
		'otherNames' => 'required|min:4',
		'email' => 'required|min:4|unique:patients.email',
		'phoneNumber' => 'required',
		'address' => 'required|min:4'
	];
	if ($validator->validate($_POST, $rules)) {
		$surname = Functions::escape(Input::catch ('surname'));
		$otherNames = Functions::escape(Input::catch ('otherNames'));
		$email = Functions::escape(Input::catch ('email'));
		$phoneNumber = Functions::escape(Input::catch ('phoneNumber'));
		$address = Functions::escape(Input::catch ('address'));
		$patient = new Patient();
		$patient->createPatient($surname, $otherNames, $address, $phoneNumber, $email);
		Functions::toast('Success');
	} else {
		Errors::allErrors($validator->getErrors());


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
                        <input type="text" id="surname" class="validate" name="surname"
                               value="<?php echo Input::catch ('surname');
						       ?>" required>
                        <label for="surname">Surname</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" id="otherNames" class="validate" name="otherNames"
                               value="<?php echo Input::catch ('otherNames');
						       ?>" required>
                        <label for="otherNames">Other Names</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" id="email" class="validate" name="email"
                               value="<?php echo Input::catch ('email');
						       ?>" required>
                        <label for="email">E-Mail</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" id="phoneNumber" class="validate" name="phoneNumber"
                               value="<?php echo Input::catch ('phoneNumber');
						       ?>" required>
                        <label for="phoneNumber">Phone Number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                            <textarea rows="" cols="" id="address" class="validate materialize-textarea" name="address"
                                      value="<?php echo Input::catch ('address');
                                      ?>" required></textarea>
                        <label for="address">Address</label>
                    </div>
                </div>
                <button type="submit" class="btn waves-effect waves-ripple waves-teal waves-light enter pink l2">Enter
                </button>
            </form>
        </div>
    </div>
</div>