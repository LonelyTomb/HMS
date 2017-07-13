<?php
use HMS\Processor\{
	HMSPaginator, Sessions, Functions, Input,Validator
};
use HMS\Modules\Admin\Admin;

$admins = new Admin();
$count = 0;

if (Input::exists()) {
	$validator = new Validator();
	$rules = array(
		'username' => 'required|min:4',
	);
	if ($validator->validate($_POST, $rules)) {
		$username = Functions::escape(Input::catch ('username'));
		$id = Functions::escape(Input::catch('id'));
		$admin = new Admin();
		$admin->updateAdmin($id,$username);
		Functions::jGrowl(['message' => 'Success', 'theme' => 'bg-success alert-styled-right alert-arrow-right']);
	} else {
		Errors::allErrors($validator->getErrors(), 'jGrowl');

	}
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
                          <form action="" class="form form-horizontal">
                        <td><?php echo ++$count; ?><input type="hidden" name="id" value="<?php echo $admin['id'] ?>" class="form-control"></td>
                        <td>
                            <div class="form-group">
                                <span class="hidden"><?php echo $admin['username'] ?></span>
                            <input type="text" name="username" value="<?php echo $admin['username'] ?>" class="form-control" placeholder="<?php echo $admin['username'] ?>">
                            </div>
                        </td>
                        <td>     <button class="btn btn-primary" name="submit">Submit</button></td>
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


