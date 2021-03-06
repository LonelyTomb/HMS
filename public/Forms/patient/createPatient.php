<?php
namespace HMS\Forms\patient;

use HMS\Processor\{
	Input, Validator, Functions, Errors
};
use HMS\Modules\Patient\Patient;
use Carbon\Carbon;


if (Input::exists()) {
	$validator = new Validator();

	$rules = [
		'surname' => 'required|min:2',
		'otherNames' => 'required|min:2',
		'email' => 'required|min:4|unique:patients.email',
		'phoneNumber' => 'required',
		'gender' => 'required',
		'dob' => 'required',
		'address' => 'required|min:4'
	];
	if ($validator->validate($_POST, $rules)) {
		$surname = Functions::escape(Input::catch ('surname'));
		$otherNames = Functions::escape(Input::catch ('otherNames'));
		$dob = new Carbon(Functions::escape(Input::catch ('dob')));
		$email = Functions::escape(Input::catch ('email'));
		$phoneNumber = Functions::escape(Input::catch ('phoneNumber'));
		$address = Functions::escape(Input::catch ('address'));
		$gender = Functions::escape(Input::catch ('gender'));
		$dob = $dob->format('Y-m-d');
		$patient = new Patient();
		$patient->createPatient($surname, $otherNames, $gender, $dob, $address, $phoneNumber, $email);
		Functions::jGrowl(['message' => 'Success', 'theme' => 'bg-success alert-styled-right alert-arrow-right']);

	} else {
		Errors::allErrors($validator->getErrors(), 'jGrowl');


	}
}


?>
<div class="panel panel-bordered panel-primary">
    <div class="panel-heading">
        <h3 class="text-bold panel-title">Patient Registeration Form</h3>


    </div>
    <div class="panel-body">
        <form action="" class="form form-horizontal" method="post" id="regForm">
            <div class="form-group">
                <label for="surname" class="control-label col-sm-2">Surname</label>
                <div class="col-sm-8">
                    <div class="row">
                        <input type="text" class="form-control" id="surname" placeholder="Please Enter Surname"
                               name="surname" value="<?php echo Input::catch ('surname'); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="otherNames" class="control-label col-sm-2">Other Names</label>
                <div class="col-sm-8">
                    <div class="row">
                        <input type="text" class="form-control" id="otherNames" placeholder="Please Enter Other Names"
                               name="otherNames" value="<?php echo Input::catch ('otherNames'); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="gender" class="control-label col-sm-2">Sex</label>
                <div class="col-sm-8">
                    <div class="row">
                        <select class="select select2-hidden-accessible" name="gender" tabindex="-1" aria-hidden="true">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="dob" class="control-label col-sm-2">Date Of Birth</label>
                <div class="col-sm-8">
                    <div class="row">
                        <input type="date" class="form-control" id="dob" placeholder="Please Enter Date OF Birth"
                               name="dob" value="<?php echo Input::catch ('phoneNumber'); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="phoneNumber" class="control-label col-sm-2">Phone Number</label>
                <div class="col-sm-8">
                    <div class="row">
                        <input type="text" class="form-control" id="phoneNumber" placeholder="Please Enter Phone Number"
                               name="phoneNumber" value="<?php echo Input::catch ('phoneNumber'); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-sm-2">Email</label>
                <div class="col-sm-8">
                    <div class="row">
                        <input type="email" class="form-control" id="email" placeholder="Please Enter Email"
                               name="email" value="<?php echo Input::catch ('email'); ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="control-label col-sm-2">Address</label>
                <div class="col-sm-8">
                    <div class="row">
                        <textarea rows=4 class="form-control elastic" id="address" placeholder="Please Enter Address"
                                  name="address"><?php echo trim(Input::catch ('address')); ?></textarea>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="panel-footer">
        <div class="heading-elements">
            <div class="heading-btn pull-right">
                <button type="submit" class="btn btn-success legitRipple" form="regForm">Submit<i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
    </div>
</div>

<script>$('.select').select2({
        minimumResultsForSearch: Infinity
    })</script>
<script>
    $(".styled").uniform({
        radioClass: 'choice'
    });
</script>