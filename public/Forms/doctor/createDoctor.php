<?php
namespace HMS\Forms\doctor;

use HMS\Processor\{
	Input, Validator, Functions, Jasonify, Errors
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

		$doctor->createDoctor($surname, $otherNames, $gender, $address, $phoneNumber, $email, $daysAvailable);
		Functions::jGrowl(['message' => 'Success', 'theme' => 'bg-success alert-styled-right alert-arrow-right']);
	} else {
		Errors::allErrors($validator->getErrors(), 'jGrowl');
	}
}


?>
<div class="panel panel-bordered panel-primary">
    <div class="panel-heading">
        <h3 class="text-bold panel-title">Doctor Registeration Form</h3>
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
                <label for="phoneNumber" class="control-label col-sm-2">Phone Number</label>
                <div class="col-sm-8">
                    <div class="row">
                        <input class="form-control" id="phoneNumber" placeholder="Please Enter Phone Number"
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

            <div class="form-group has-padding">

                <label class="text-semibold">Days Available (optional)</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="daysAvailable[]" value="Sunday" class="styled"/>
                                Sunday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="daysAvailable[]" value="Monday" class="styled"/>
                                Monday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="daysAvailable[]" value="Tuesday" class="styled"/>
                                Tuesday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="daysAvailable[]" value="Wednesday" class="styled"/>
                                Wednesday
                            </label>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="daysAvailable[]" value="Thursday" class="styled"/>
                                Thursday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="daysAvailable[]" value="Friday" class="styled"/>
                                Friday
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="daysAvailable[]" value="Saturday" class="styled"/>
                                Saturday
                            </label>
                        </div>

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