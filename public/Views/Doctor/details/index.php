<?php
require "../../../../vendor/autoload.php";

use HMS\Processor\{
	Site, Auth, Input, Validator, Sessions, Functions, Jasonify, Errors
};

use Carbon\Carbon;

Auth::confirmLogin();


?>

<?php

use HMS\Modules\Doctor\{Doctor,Specialist};

if(Sessions::get('user/type') == 'doctor'){
	$user = new Doctor();
}elseif(Sessions::get('user/type') == 'specialist'){
	$user = new Specialist();
}

$doctor = $user->getDetail(Sessions::get('user/username'), Sessions::get('user/type'));
if (Input::exists()) {
	$validator = new Validator();
	$rules = [
		'surname' => 'required|min:2',
		'otherNames' => 'required|min:2',
		'email' => 'required|min:4',
		'phoneNumber' => 'required|max:11',
		'address' => 'required',
		'gender' => 'required'
	];
	if ($validator->validate($_POST, $rules)) {
		$doctorId = Sessions::get('user/username');
		$surname = Functions::escape(Input::catch ('surname'));
		$otherNames = Functions::escape(Input::catch ('otherNames'));
		$email = Functions::escape(Input::catch ('email'));
		$phoneNumber = Functions::escape(Input::catch ('phoneNumber'));
		$gender = Functions::escape(Input::catch ('gender'));
		$status = Functions::escape(Input::catch ('status'));
		$address = Functions::escape(Input::catch ('address'));
		$specialization = Functions::escape(Input::catch ('specialization'));
		if(Sessions::get('user/type') == 'doctor'){
			$count = $user->updateDoctor($doctorId, $surname, $otherNames, $gender, $address, $phoneNumber, $email, $status);
		}elseif(Sessions::get('user/type') == 'specialist'){
			$count = $user->updateSpecialist($doctorId, $surname, $otherNames, $specialization,$gender, $address, $phoneNumber, $email);
		}

		if($count->rowCount() > 0){
			Functions::jGrowl(['message' => 'Success', 'theme' => 'bg-success alert-styled-right alert-arrow-right']);
		}else{
			Functions::jGrowl(['message' => 'No Changes Made', 'theme' => 'bg-info alert-styled-right alert-arrow-right']);
		}



		Functions::redirect('Views/Doctor/details/');
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
<main class="details container">

	<div class="card">
		<div class="card-title center-align pink-text lighten-2"><h2><?php echo $doctor['surname']; ?>'s Details</h2>
		</div>
		<div class="card-content">
			<form action="" class="form form-vertical" method="POST" id="<?php echo $doctor['id'] ?>">
				<div class="row">
					<div class="input-field">
						<div class="form-group">
							<input type="text" name="doctorId" value="<?php $type = Sessions::get('user/type');
							echo $doctor["{$type}Id"]; ?>"
							       class="form-control" disabled>
							<label for="doctorId">Doctor ID</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<div class="form-group">
							<input type="text" name="surname" value="<?php echo $doctor['surname'] ?>"
							       class="form-control">
							<label for="surname">Surname</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<div class="form-group">
							<input type="text" name="otherNames" id="otherNames" value="<?php echo $doctor['otherNames'] ?>"
							       class="form-control">
							<label for="otherNames">Other Names</label>
						</div>
					</div>
				</div>
				<?php if(Sessions::get('user/type') == 'specialist'):?>
				<div class="row">
					<div class="input-field">
						<div class="form-group">
							<input type="text" name="specialization" id="specialiaztion" value="<?php echo $doctor['specialization'] ?>"
							       class="form-control">
							<label for="specialization">specialization</label>
						</div>
					</div>
				</div>
				<?php endif;?>
				<div class="row">
					<div class="input-field">
						<div class="form-group">
							<select name="gender" id="gender">
								<option value="male" <?php if ($doctor['gender'] == 'male') echo 'selected'; ?>>Male</option>
								<option value="female" <?php if ($doctor['gender'] == 'female') echo 'selected'; ?>>Female</option>
							</select>

							<label for="gender">Gender</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<div class="form-group">
							<input type="text" name="address" value="<?php echo $doctor['address'] ?>"
							       class="form-control">
							<label for="address">Address</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<div class="form-group">
							<input type="text" name="phoneNumber" value="<?php echo $doctor['phoneNumber'] ?>"
							       class="form-control">
							<label for="phoneNumber">Phone Number</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<div class="form-group">
							<input type="text" name="email" value="<?php echo $doctor['email'] ?>"
							       class="form-control">
							<label for="email">E-mail</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<div class="form-group">
							<select name="status" id="status">
								<option value="Available" <?php if ($doctor['status'] == 'male') echo 'selected'; ?>>Available</option>
								<option value="Unavailable" <?php if ($doctor['status'] == 'female') echo 'selected'; ?>>Unavailable</option>
							</select>
							<label for="status">Status</label>
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