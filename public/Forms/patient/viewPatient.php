<?php
use HMS\Processor\{
	HMSPaginator, Sessions, Functions, Input
};
use HMS\Modules\Patient\Patient;

$patients = new Patient();
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
                <th>Patient Id</th>
                <th>Surname</th>
                <th>Other Names</th>
                <th>Gender</th>
                <th>Date Of Birth</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Email Address</th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ($patients->getAllPatients() as $patient): ?>
                <tr>
                    <td><?php echo ++$count; ?></td>
                    <td><?php echo $patient['patientId']; ?></td>
                    <td><?php echo $patient['surname']; ?></td>
                    <td><?php echo $patient['otherNames']; ?></td>
                    <td><?php echo $patient['gender']; ?></td>
                    <td><?php echo $patient['date_of_birth']; ?></td>
                    <td><?php echo $patient['address']; ?></td>
                    <td><?php echo $patient['phoneNumber']; ?></td>
                    <td><?php echo $patient['email']; ?></td>

                </tr>
			<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>

</script>


