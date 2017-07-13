<?php
/**
 * Created by PhpStorm.
 * User: lonelytomb
 * Date: 7/13/17
 * Time: 3:38 AM
 */
use HMS\Processor\{
	Validator, Functions, Input, Errors
};
use HMS\Modules\Patient\Patient;
use Carbon\Carbon;

$patients = new Patient();
$count = 0;
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
		$dob = $dob->format('Y-m-d');
		$patient = new Patient();
		$patient->createPatient($surname, $otherNames, $gender, $dob, $address, $phoneNumber, $email);
		$patient->deletePendingUser($email);
		Functions::jGrowl(['message' => 'Success', 'theme' => 'bg-success alert-styled-right alert-arrow-right']);
	} else {
		Errors::allErrors($validator->getErrors(), 'jGrowl');
	}
}

?>

<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">View Pending patients</h5>
		<div class="heading-elements">
			<ul class="icons-list">
				<li><a data-action="collapse"></a></li>
				<li><a data-action="reload"></a></li>
				<li><a data-action="close"></a></li>
			</ul>
		</div>
	</div>

	<div class="panel-body">
		<form action="" method="post" id="form">
			<table class="table datatable-basic table-bordered table-striped table-hover datatable-responsive">
				<thead>
				<tr>
					<th>No</th>
					<th>Surname</th>
					<th>Other Names</th>
					<th>Gender</th>
					<th>Date Of Birth</th>
					<th>Address</th>
					<th>Phone Number</th>
					<th>Email Address</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($patients->getPendingUsers('patient') as $patient): ?>

					<tr>
						<form action="" class="form form-vertical" method="POST" id="<?php echo $patient['id'] ?>">
							<td><?php echo ++$count; ?></td>
							<td>
								<div class="form-group">
									<span class="hidden"><?php echo $patient['surname'] ?></span>
									<input type="text" name="surname" value="<?php echo $patient['surname'] ?>"
									       class="form-control">
								</div>
							</td>


							<td>
								<div class="form-group">
									<span class="hidden"><?php echo $patient['otherNames'] ?></span>
									<input type="text" name="otherNames" value="<?php echo $patient['otherNames'] ?>"
									       class="form-control">
								</div>
							</td>


							<td>
								<div class="form-group">
									<span class="hidden"><?php echo $patient['gender'] ?></span>
									<input type="text" name="gender" value="<?php echo $patient['gender'] ?>"
									       class="form-control">
								</div>
							</td>


							<td>
								<div class="form-group">
									<span class="hidden"><?php echo $patient['date_of_birth'] ?></span>
									<input type="text" name="dob" value="<?php echo $patient['date_of_birth'] ?>"
									       class="form-control">
								</div>
							</td>


							<td>
								<div class="form-group">
									<span class="hidden"><?php echo $patient['address'] ?></span>
									<input type="text" name="address" value="<?php echo $patient['address'] ?>"
									       class="form-control">
								</div>
							</td>


							<td>
								<div class="form-group">
									<span class="hidden"><?php echo $patient['phoneNumber'] ?></span>
									<input type="text" name="phoneNumber" value="<?php echo $patient['phoneNumber'] ?>"
									       class="form-control">
								</div>
							</td>


							<td>
								<div class="form-group">
									<span class="hidden"><?php echo $patient['email'] ?></span>
									<input type="text" name="email" value="<?php echo $patient['email'] ?>"
									       class="form-control">
								</div>
							</td>
							<td>
								<button class="btn btn-primary" name="submit">Submit</button>
							</td>
						</form>
					</tr>
				<?php endforeach; ?>
				</tbody>

			</table>
		</form>
	</div>
</div>
<script>

</script>
