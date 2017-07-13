<?php
/**
 * Created by PhpStorm.
 * User: lonelytomb
 * Date: 7/13/17
 * Time: 6:29 AM
 */
use HMS\Processor\{
	Validator, Sessions, Functions, Input,Jasonify,Errors
};
use HMS\Modules\Patient\Patient;
use Carbon\Carbon;

$patients = new Patient();
$count = 0;
if (Input::exists()) {

		$patientId = Functions::escape(Input::catch ('patientId'));
		$patient = new Patient();
		$patient->deleteUser($patientId,'patient');
		Functions::jGrowl(['message' => 'Success', 'theme' => 'bg-success alert-styled-right alert-arrow-right']);
}

?>

<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">View Registered patients</h5>
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
					<th>Patient Id</th>
					<th>Surname</th>
					<th>Other Names</th>
					<th>Gender</th>
					<th>Email Address</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($patients->getAllPatients() as $patient): ?>

					<tr>
						<form action="" class="form form-vertical" method="POST" id="<?php echo $patient['id'] ?>">
							<td><?php echo ++$count; ?></td>
							<td>
								<div class="form-group">
									<span class=""><?php echo $patient['patientId'] ?></span>
									<input type="hidden" name="patientId" value="<?php echo $patient['patientId'] ?>"
									       class="form-control disabled">
								</div>
							</td>

							<td>
								<div class="form-group">
									<p class=""><?php echo $patient['surname'] ?></p>
								</div>
							</td>


							<td>
								<div class="form-group">
									<p class=""><?php echo $patient['otherNames'] ?></p>
								</div>
							</td>


							<td>
								<div class="form-group">
									<p class=""><?php echo $patient['gender'] ?></p>
								</div>
							</td>
							<td>
								<div class="form-group">
									<p class=""><?php echo $patient['email'] ?></p>
								</div>
							</td>
							<td>
								<button class="btn btn-warning" name="submit">Delete</button>
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



