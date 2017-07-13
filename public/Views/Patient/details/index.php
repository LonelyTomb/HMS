<?php
require "../../../../vendor/autoload.php";

use HMS\Processor\{
	Site, Auth, Input, Validator, Sessions, Functions, Jasonify,Errors
};

use Carbon\Carbon;

Auth::confirmLogin();
?>

<?php

use HMS\Modules\Patient\Patient;

$user = new Patient();
$patient = $user->getDetail(Sessions::get('user/username'),Sessions::get('user/type'));
if (Input::exists()) {
	$validator = new Validator();
	$rules = [
		'surname' => 'required|min:2',
		'otherNames' => 'required|min:2',
		'email' => 'required|min:4',
		'phoneNumber' => 'required',
		'gender' => 'required',
		'dob' => 'required',
		'address' => 'required|min:4'
	];
	if ($validator->validate($_POST, $rules)) {
        $patientId = Functions::escape(Input::catch ('patientId'));
		$surname = Functions::escape(Input::catch ('surname'));
		$otherNames = Functions::escape(Input::catch ('otherNames'));
		$email = Functions::escape(Input::catch ('email'));
		$phoneNumber = Functions::escape(Input::catch ('phoneNumber'));
		$gender = Functions::escape(Input::catch ('gender'));
		$address = Functions::escape(Input::catch ('address'));
        $dob = new Carbon(Functions::escape(Input::catch ('dob')));
		$patient = new Patient();
        $patient->updatePatient($patientId,$surname, $otherNames, $gender, $dob, $address, $phoneNumber, $email);
		Functions::jGrowl(['message' => 'Success', 'theme' => 'bg-success alert-styled-right alert-arrow-right']);
		Functions::redirect('Views/Patient/details/');
	} else {
		Errors::allErrors($validator->getErrors(), 'jGrowl');
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php Site::setPageTitle('Details');
	Site::reqAbs('Views/Parts/head.php'); ?>
</head>
<body>
<header>
	<?php Site::reqAbs('Views/Parts/navbar.php'); ?>
</header>

<main class="details row">
					<div class="card">
					<div class="card-title"><h2><?php echo $patient['surname']; ?>'s Details</h2></div>
					<div class="card-content">
        
                        <form action="" class="form form-vertical" method="POST" id="<?php echo $patient['id'] ?>">
                        		<div class="row"><div class="input-field">
                                <div class="form-group">
                                    <input type="text" name="patientId" value="<?php echo $patient['patientId'] ?>"
                                           class="form-control disabled">
                                           <label for="patientId">Patient ID</label>
                                </div>
                                </div>
                                </div>
                                <div class="row"><div class="input-field">
                                <div class="form-group">
                                    <input type="text" name="surname" value="<?php echo $patient['surname'] ?>"
                                           class="form-control">
                                           <label for="surname">Surname</label>
                                </div>
                                </div>
                                </div>
                                <div class="row"><div class="input-field">
                                <div class="form-group">
                                    <input type="text" name="otherNames" value="<?php echo $patient['otherNames'] ?>"
                                           class="form-control">
                                           <label for="otherNames">Other Names</label>
                                </div>
                                </div>
                                </div>
                                <div class="row"><div class="input-field">
                                <div class="form-group">
                                    <input type="text" name="gender" value="<?php echo $patient['gender'] ?>"
                                           class="form-control">
                                           <label for="gender">Gender</label>
                                </div>
                                </div>
                                </div>
                                <div class="row"><div class="input-field">
                                <div class="form-group">
                                    <input type="text" name="dob" value="<?php echo $patient['date_of_birth'] ?>"
                                           class="form-control">
                                           <label for="dob">DOB</label>
                                </div>
                                </div>
                                </div>
                                <div class="row"><div class="input-field">
                                <div class="form-group">
                                    <input type="text" name="address" value="<?php echo $patient['address'] ?>"
                                           class="form-control">
                                           <label for="address">Address</label>
                                </div>
                                </div>
                                </div>
                                <div class="row"><div class="input-field">
                                <div class="form-group">
                                    <input type="text" name="phoneNumber" value="<?php echo $patient['phoneNumber'] ?>"
                                           class="form-control">
                                           <label for="phoneNumber">Phone Number</label>
                                </div>
                                </div>
                                </div>
                                <div class="row"><div class="input-field">
                                <div class="form-group">
                                    <input type="text" name="email" value="<?php echo $patient['email'] ?>"
                                           class="form-control">
                                           <label for="email">E-Mail</label>
                                </div>
                                </div>
                                </div>
                            <button class="btn btn-primary" name="submit">Submit</button>
                        </form>
                    </div>
                    </div>
                        </main>

<?php Site::reqAbs('Views/Parts/footer.php'); ?>

</body>

</html>