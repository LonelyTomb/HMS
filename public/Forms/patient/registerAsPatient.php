<?php
namespace HMS\Forms\patient;

use HMS\Processor\{
	Input, Validator, Functions, Errors,Sessions
};
use HMS\Modules\Patient\Patient;
use Carbon\Carbon;

if (Input::exists()) {
	$validator = new Validator();

	$rules = [
		'surname' => 'required|min:2',
		'otherNames' => 'required|min:2',
		'email' => 'required|min:4|unique:pending_registration.email',
		'phoneNumber' => 'required',
		'address' => 'required|min:4',
		'gender' => 'required',
		'dob' => 'required'
	];
	if ($validator->validate($_POST, $rules)) {

	    $surname = Functions::escape(Input::catch ('surname'));
		$otherNames = Functions::escape(Input::catch ('otherNames'));
		$email = Functions::escape(Input::catch ('email'));
		$dob = new Carbon(Functions::escape(Input::catch ('dob')));
		$dob = $dob->format('Y-m-d');
		$phoneNumber = Functions::escape(Input::catch ('phoneNumber'));
		$address = Functions::escape(Input::catch ('address'));
		$gender = Functions::escape(Input::catch ('gender'));

		$patient = new Patient();
		$patient->registerAsPatient($surname, $otherNames, $gender, $address, $phoneNumber, $dob, $email);

		Functions::toast('Success');
		// Sessions::flash('Registration msg', '<p>Registration Successful.</p><p>Please Check inbox to view login details after reistration details are confirmed</p>');

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
                        <select name="gender" id="gender">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <label for="gender">Sex</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <label for="dob">Date Of Birth</label>
                        <input id="dob" name="dob" type="text" class="datepicker"
                               value="<?php echo Input::catch ('dob'); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="address" id="address" cols="30" rows="10"
                                  class="materialize-textarea"><?php echo Input::catch ('address') ?></textarea>
                        <label for="address">Address</label>
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
                <button type="submit" class="btn waves-effect waves-ripple waves-teal waves-light enter pink l2">Enter
                </button>
            </form>
        </div>
    </div>
</div>