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
use HMS\Modules\Doctor\Specialist;

$specialists = new Specialist();
$count = 0;
if (Input::exists()) {

		$specialistId = Functions::escape(Input::catch ('specialistId'));

		$specialist = new Specialist();
		$specialist->deleteUser($specialistId,'specialist');
		Functions::jGrowl(['message' => 'Success', 'theme' => 'bg-success alert-styled-right alert-arrow-right']);

}

?>

<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">View Registered specialists</h5>
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
					<th>Specialist Id</th>
					<th>Surname</th>
					<th>Other Names</th>
					<th>Specialization</th>
					<th>Gender</th>
					<th>Email Address</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($specialists->getSpecialists() as $specialist): ?>

					<tr>
						<form action="" class="form form-vertical" method="POST" id="<?php echo $specialist['id'] ?>">
							<td><?php echo ++$count; ?></td>
							<td>
								<div class="form-group">
									<p class=""><?php echo $specialist['specialistId'] ?></p>
									<input type="hidden" name="specialistId" value="<?php echo $specialist['specialistId'] ?>"
									       class="form-control disabled">
								</div>
							</td>

							<td>
								<div class="form-group">
									<p class=""><?php echo $specialist['surname'] ?></p>
								</div>
							</td>


							<td>
								<div class="form-group">
									<p class=""><?php echo $specialist['otherNames'] ?></p>
								</div>
							</td>

							<td>
								<div class="form-group">
									<p class=""><?php echo $specialist['specialization'] ?></p>

								</div>
							</td>


							<td>
								<div class="form-group">
									<p class=""><?php echo $specialist['gender'] ?></p>

								</div>
							</td>

							<td>
								<div class="form-group">
									<p class=""><?php echo $specialist['email'] ?></p>

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


