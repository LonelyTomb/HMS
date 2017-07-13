<?php
use HMS\Processor\{
	HMSPaginator, Sessions, Functions, Input
};
use HMS\Modules\Admin\Admin;

$admins = new Admin();
$count = 0;
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
        <table class="table datatable-basic table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ($admins->getAllAdmin() as $admin): ?>
                <tr>
                    <td><?php echo ++$count; ?></td>
                    <td><?php echo $admin['username']; ?></td>
                </tr>
			<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>

</script>


