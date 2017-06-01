<?php
use HMS\Processor\{
	HMSPaginator, Sessions, Functions, Input
};
use HMS\Modules\Doctor\Doctor;

$doctors = new Doctor();
$count = 0;
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
        <table class="table datatable-basic table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>No</th>
                <th>Patient Id</th>
                <th>Surname</th>
                <th>Other Names</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Email Address</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ($doctors->getDoctors() as $doctor): ?>
                <tr>
                    <td><?php echo ++$count; ?></td>
                    <td><?php echo $doctor['doctorId']; ?></td>
                    <td><?php echo $doctor['surname']; ?></td>
                    <td><?php echo $doctor['otherNames']; ?></td>
                    <td><?php echo $doctor['gender']; ?></td>
                    <td><?php echo $doctor['address']; ?></td>
                    <td><?php echo $doctor['phoneNumber']; ?></td>
                    <td><?php echo $doctor['email']; ?></td>
                    <td><?php echo $doctor['status']; ?></td>

                </tr>
			<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>

</script>


