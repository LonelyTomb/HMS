<?php

use HMS\Modules\Doctor\Specialist;

use HMS\Modules\Patient\Patient;
use HMS\Processor\{
	Sessions, HMSPaginator, Input, Errors, Functions
};

$patient = new Patient();
$patientId = $patient->getIdDb(Sessions::get('user/username'));


$specialists = new Specialist();
/**
 * Pagination
 */
$paginator = new HMSPaginator($specialists->getSpecialists(), 'type=specialist', 3);

if (Input::getExists('make')) {
	if ($patient->makeAppointment() === true) {
		Functions::toast('Appointment Made.');
		Functions::redirect('Views/Patient/appointments/index.php?ongoing');
	} else {
		Errors::allErrors(Errors::getError());

	}
}

?>

    <div class="col s10 m8 hms_officials offset-m1">
        <p><h4 class="center-align">Available Appointments For
            Today: <?php echo $patient->getAptCounter($patient->getIdDb(Sessions::get('user/username'))); ?></h4></p>
        <div class="row">
			<?php
			foreach ($paginator->getPagination()->getItems() as $specialist) {
				$speId = $specialists->getIdDb($specialist['specialistId']);
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

				if ($status === 'Unavailable' || $specialist['maxPatients'] === $specialist['currentPatients']) {
					echo '<p>Not Available</p>';
				} else {
					echo "<a href='?type=specialist&make&id={$patientId}&docId={$speId}' class='waves waves-ripple red btn' data-position='bottom' data-delay='50' data-tooltip='Make Appointment'>Make</a>";
				}
				echo '    <p class="clearfix"></p>
                </div>
            </div>
            </div>
        ';
			}
			?>
        </div>
    </div>
    <p class="clearfix"></p>
<?php
echo $paginator->getPageUrl();
?>