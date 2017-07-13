<?php
namespace HMS\Forms\doctor;

use HMS\Processor\{
	Input, Sessions, Validator, Functions, Jasonify, Errors
};
use HMS\Modules\Doctor\Doctor;


if (Input::exists()) {
	$validator = new Validator();
	$rules = [
		'surname' => 'required|min:2',
		'otherNames' => 'required|min:2',
		'email' => 'required|min:4|unique:doctors.email',
		'phoneNumber' => 'required|max:11',
		'address' => 'required',
		'gender' => 'required'
	];
	if ($validator->validate($_POST, $rules)) {
		$surname = Functions::escape(Input::catch ('surname'));
		$otherNames = Functions::escape(Input::catch ('otherNames'));
		$email = Functions::escape(Input::catch ('email'));
		$phoneNumber = Functions::escape(Input::catch ('phoneNumber'));
		$gender = Functions::escape(Input::catch ('gender'));
		$daysAvailable = Input::catch ('daysAvailable') === '' ? null : Jasonify::toJson(Input::catch ('daysAvailable'));
		$address = Functions::escape(Input::catch ('address'));

		$doctor = new Doctor();
		$doctor->registerAsDoctor($surname, $otherNames, $gender, $address, $phoneNumber, $email, $daysAvailable);
		Functions::toast('Success');

		// Sessions::flash('Registration msg', '<p>Registration Successful.</p><p>Please Check inbox to view login details after registration details are confirmed</p>');
	} else {
		Errors::allErrors($validator->getErrors(), 'jGrowl');
	}
}


?>
<div class="container">
    <div class="card z-depth-3">
        <div class="card-content">
            <form action="" class="" method="POST">
                <h3 class="flow-text left-align ">CREATE DOCTOR</h3>
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
                                  class="materialize-textarea"><?php Input::catch ('address') ?></textarea>
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
                        <p>Days Available</p>
                        <p>
                            <input type="checkbox" id="sunday" class="validate filled-in" name="daysAvailable[]"
                                   value="Sunday">
                            <label for="sunday">Sunday</label>
                        </p>
                        <p>
                            <input type="checkbox" id="monday" class="validate filled-in" name="daysAvailable[]"
                                   value="Monday">
                            <label for="monday">Monday</label>
                        </p>
                        <p>
                            <input type="checkbox" id="tuesday" class="validate filled-in" name="daysAvailable[]"
                                   value="Tuesday">
                            <label for="tuesday">Tuesday</label>
                        </p>
                        <p>
                            <input type="checkbox" id="wednesday" class="validate filled-in" name="daysAvailable[]"
                                   value="Wednesday">
                            <label for="wednesday">Wednesday</label>
                        </p>
                        <p>
                            <input type="checkbox" id="thursday" class="validate filled-in" name="daysAvailable[]"
                                   value="Thursday">
                            <label for="thursday">Thursday</label>
                        </p>
                        <p>
                            <input type="checkbox" id="friday" class="validate filled-in" name="daysAvailable[]"
                                   value="Friday">
                            <label for="friday">Friday</label>
                        </p>
                        <p>
                            <input type="checkbox" id="saturday" class="validate filled-in" name="daysAvailable[]"
                                   value="Saturday">
                            <label for="saturday">Saturday</label>
                        </p>
                    </div>
                </div>
                <button type="submit" class="btn waves-effect waves-ripple waves-teal waves-light enter pink l2">Enter
                </button>
            </form>
        </div>
    </div>
</div>