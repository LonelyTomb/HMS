<?php
/**
 * Created by PhpStorm.
 * User: lonelytomb
 * Date: 7/13/17
 * Time: 6:28 AM
 */

use HMS\Processor\{
	Validator, Sessions, Functions, Input,Jasonify,Errors
};
use HMS\Modules\Doctor\Doctor;

$doctors = new Doctor();
$count = 0;
if (Input::exists()) {


		$doctorId = Functions::escape(Input::catch ('doctorId'));
		$doctor = new Doctor();
		$doctor->deleteUser($doctorId,'doctor');
		Functions::jGrowl(['message' => 'Success', 'theme' => 'bg-success alert-styled-right alert-arrow-right']);

}

?>

<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">View Registered Doctors</h5>
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
					<th>Doctor Id</th>
					<th>Surname</th>
					<th>Other Names</th>
					<th>Gender</th>
					<th>Email Address</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($doctors->getDoctors() as $doctor): ?>

					<tr>
						<form action="" class="form form-vertical" method="POST" id="<?php echo $doctor['id'] ?>">
							<td><?php echo ++$count; ?></td>
							<td>
								<div class="form-group">
									<p class=""><?php echo $doctor['doctorId'] ?></p>
									<input type="hidden" name="doctorId" value="<?php echo $doctor['doctorId'] ?>"
									       class="form-control disabled">
								</div>
							</td>

							<td>
								<div class="form-group">
									<p class=""><?php echo $doctor['surname'] ?></p>

								</div>
							</td>


							<td>
								<div class="form-group">
									<p class=""><?php echo $doctor['otherNames'] ?></p>

								</div>
							</td>


							<td>
								<div class="form-group">
									<p class=""><?php echo $doctor['gender'] ?></p>

								</div>
							</td>

							<td>
								<div class="form-group">
									<p class=""><?php echo $doctor['email'] ?></p>

								</div>
							</td>

							<td>
								<button class="btn btn-danger" name="submit">Delete</button>
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