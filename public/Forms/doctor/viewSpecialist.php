<?php
use HMS\Processor\{
	HMSPaginator, Sessions, Functions, Input
};
use HMS\Modules\Doctor\Specialist;

$specialists = new Specialist();
$count = 0;
?>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">View Registered Specialists</h5>
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
                <th>Specialist Id</th>
                <th>Surname</th>
                <th>Other Names</th>
                <th>Specialization</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Email Address</th>
                <th>Max Patients</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ($specialists->getSpecialists() as $specialist): ?>
                <tr>
                    <td><?php echo ++$count; ?></td>
                    <td><?php echo $specialist['specialistId']; ?></td>
                    <td><?php echo $specialist['surname']; ?></td>
                    <td><?php echo $specialist['otherNames']; ?></td>
                    <td><?php echo $specialist['specialization']; ?></td>
                    <td><?php echo $specialist['gender']; ?></td>
                    <td><?php echo $specialist['address']; ?></td>
                    <td><?php echo $specialist['phoneNumber']; ?></td>
                    <td><?php echo $specialist['email']; ?></td>
                    <td><?php echo $specialist['maxPatients']; ?></td>
                    <td><?php echo $specialist['status']; ?></td>

                </tr>
			<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>

</script>


