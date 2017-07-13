<?php
use HMS\Modules\Doctor\{
	Doctor
};

use HMS\Modules\Patient\Patient;
use HMS\Processor\{
	Jasonify, Functions, Sessions, Input, Errors, HMSPaginator
};

$doctors = new Doctor();

/**
 * Pagination
 */
$paginator = new HMSPaginator($doctors->getDoctors(), 'type=doctor', 2);
$pagination = $paginator->getPagination();

$patient = new Patient();
$patientId = $patient->getIdDb(Sessions::get('user/username'));


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
		foreach ($pagination->getItems() as $doctor) {
			$docId = $doctors->getIdDb($doctor['doctorId']);
			echo '
            <div class="col l5 s10 doctor_outline">
                <div class="card">
                <div class="card-content">
                    <p class="name"><h5>Doctor ';

			echo $doctor['surname'];

			echo '</h5></p>';

			$daysAvailable = Jasonify::toArray($doctor['daysAvailable']);

			echo '</div>
            <div class="card-action">';
			if ($daysAvailable === '' || $doctor['status'] === 'Unavailable') {
				echo '<p>Not Available</p>';
			} else {
				echo "<a href='?type=doctor&make&id={$patientId}&docId={$docId}' class='waves waves-effect red btn' data-position='bottom' data-delay='50' data-tooltip='Make Appointment'>Make</a>";
				foreach ($daysAvailable as $day) {
					echo "<span class='new badge cyan' data-badge-caption=''>$day</span>";
				}
			}
			echo '
    <p class="clearfix"></p>
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


