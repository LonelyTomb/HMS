<?php
/**
 * Created by PhpStorm.
 * User: lonelytomb
 * Date: 7/13/17
 * Time: 6:29 AM
 */

use HMS\Processor\{
	HMSPaginator, Sessions, Functions, Input,Validator
};
use HMS\Modules\Admin\Admin;

$admins = new Admin();
$count = 0;

if (Input::exists()) {
		$username = Functions::escape(Input::catch ('username'));
		$id = Functions::escape(Input::catch('id'));
		$admin = new Admin();
		$admin->deleteUser($id,'admin');
		Functions::jGrowl(['message' => 'Success', 'theme' => 'bg-success alert-styled-right alert-arrow-right']);

}
?>

<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">View Registered Admin</h5>
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
			<table class="table datatable-basic table-bordered table-striped table-hover">
				<thead>
				<tr>
					<th>No</th>
					<th>Username</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($admins->getAllAdmin() as $admin): ?>
				<tr>
					<form action="" class="form form-horizontal" method="post">
						<td><?php echo ++$count; ?><input type="hidden" name="id" value="<?php echo $admin['id'] ?>" class="form-control"></td>
						<td>
							<div class="form-group">
								<p class=""><?php echo $admin['username'] ?></p>

							</div>
						</td>
						<td>     <button class="btn btn-danger" name="submit">Delete</button></td>
				</tr>
		</form>
		<?php endforeach; ?>
		</tbody>

		</table>
		<button class="btn btn-primary" name="submit">Submit</button>
		</form>
	</div>
</div>
<script>

</script>