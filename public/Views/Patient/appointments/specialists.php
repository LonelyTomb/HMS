<?php

use AshleyDawson\SimplePagination\Paginator;
use HMS\Modules\Doctor\{
	Specialist
};
use HMS\Modules\Patient\Patient;
use HMS\Processor\{
	Sessions, HMSPaginator
};

$specialists = new Specialist();
$paginator = new HMSPaginator($specialists->getSpecialists(), 2);
$pagination = $paginator->getPagination();

$patient = new Patient();
$patientId = $patient->getId(Sessions::get('user/username'));
?>

<div class="col s10 m8 hms_officials offset-m1">
    <h4 class="center-align">Available Appointments</h4>
    <div class="row">
		<?php
		foreach ($pagination->getItems() as $specialist) {
			$speId = $specialists->getId($specialist['specialistId']);
			echo '
            <div class="col l5 s10 specialist_outline">
                <div class="card">
                <div class="card-content">
                    <p class="name">
                        <h5>Specialist ';

			echo $specialist['surname'];

			echo '        </h5>
                    </p>';

			$status = $specialist['status'];

			echo '      </div>
            <div class="card-action">';

			if ($status === 'Unavailable') {
				echo '<p>Not Available</p>';
			} else {
				echo "<a href='?make&id={$patientId}&type=specialist&docId={$speId}' class='waves waves-ripple red btn' data-position='bottom' data-delay='50' data-tooltip='Make Appointment'>Make</a>";
			}
			echo '    <p class="clearfix"></p>
                </div>
            </div>
            </div>
        ';
		}
		?>
    </div>
	<?php
	foreach ($pagination->getPages() as $page) {
		echo '<a href="?specialists&page=' . $page . '">' . $page . '</a> ';
	}
	?>
</div>