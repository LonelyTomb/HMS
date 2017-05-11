<?php
namespace HMS\Forms\doctor;

use HMS\Processor\{
	Input, Validator, Functions, Jasonify, Errors
};
use HMS\Modules\Doctor\Doctor;


if (Input::exists()) {
	$validator = new Validator();
	$rules = [
		'surname' => 'required|min:4',
		'otherNames' => 'required|min:4',
		'email' => 'required|min:4|unique:doctors.email',
		'phoneNumber' => 'required|min:4'
	];
	if ($validator->validate($_POST, $rules)) {
		$surname = Functions::escape(Input::catch ('surname'));
		$otherNames = Functions::escape(Input::catch ('otherNames'));
		$email = Functions::escape(Input::catch ('email'));
		$phoneNumber = Functions::escape(Input::catch ('phoneNumber'));
		$daysAvailable = Jasonify::toJson(Input::catch ('daysAvailable'));
		$doctor = new Doctor();
		$doctor->createDoctor($surname, $otherNames, $phoneNumber, $email, $daysAvailable);
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