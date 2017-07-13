<?php
namespace HMS\Forms\doctor;

use HMS\Processor\{
	Input, Validator, Functions, Sessions, Errors
};
use HMS\Modules\Doctor\Specialist;

if (Input::exists()) {
	$validator = new Validator();
	$rules = [
		'surname' => 'required|min:2',
		'otherNames' => 'required|min:2',
        'specialization' => 'required',
		'gender' => 'required',
		'email' => 'required|min:4|unique:specialists.email',
		'phoneNumber' => 'required|min:4',
		'address' => 'required',
		'maxPatients' => 'required'
	];
	if ($validator->validate($_POST, $rules)) {
		$surname = Functions::escape(Input::catch ('surname'));
		$otherNames = Functions::escape(Input::catch ('otherNames'));
        $specialization = Functions::escape(Input::catch ('specialization'));
		$email = Functions::escape(Input::catch ('email'));
		$phoneNumber = Functions::escape(Input::catch ('phoneNumber'));
		$gender = Functions::escape(Input::catch ('gender'));
		$address = Functions::escape(Input::catch ('address'));
		$maxPatients = Functions::escape(Input::catch ('maxPatients'));
		$specialist = new Specialist();
		$specialist->registerAsSpecialist($surname, $otherNames, $specialization, $gender, $address, $phoneNumber, $email, $maxPatients);
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
                <h3 class="flow-text center-align ">Register As SPECIALIST</h3>
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
                <div class="form-group">
                <label for="specialization" class="control-label col-sm-2">Specialization</label>
                <div class="col-sm-8">
                    <div class="row">
                        <input type="text" class="form-control" id="specialization" placeholder="Please Enter Specialization"
                               name="specialization" value="<?php echo Input::catch ('specialization'); ?>">
                    </div>
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
                        <textarea name="address" id="address" cols="30" rows="10"
                                  class="materialize-textarea"><?php Input::catch('address')?></textarea>
                        <label for="address">Address</label>
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
                        <input type="text" id="maxPatients" class="validate" name="maxPatients"
                               value="<?php echo Input::catch ('maxPatients');
						       ?>" required>
                        <label for="maxPatients">Max Patients:</label>
                    </div>
                </div>
                <button type="submit" class="btn waves-effect waves-ripple waves-teal waves-light enter pink l2">Enter
                </button>
            </form>
        </div>
    </div>
</div>