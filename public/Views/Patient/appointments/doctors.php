<?php
use HMS\Modules\Doctor\{
	Doctor, Specialist
};

use HMS\Modules\Patient\Patient;
use HMS\Processor\{
	Jasonify, Functions, Sessions, Input, Errors, Site
};

$doctors = new Doctor();
$allDoctors = $doctors->getDoctors();

$specialists = new Specialist();
$allSpecialists = $specialists->getSpecialists();
$patient = new Patient();
$patientId = $patient->getId(Sessions::get('user/username'));


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
    <h4 class="center-align">Available Appointments</h4>
    <div class="row">
		<?php
		foreach ($allDoctors as $doctor) {
			$docId = $doctors->getId($doctor['doctorId']);
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

			if ($daysAvailable === "") {
				echo '<p>Not Available</p>';
			} else {
				echo "<a href='?make&id={$patientId}&type=doctor&docId={$docId}' class='waves waves-ripple red btn' data-position='bottom' data-delay='50' data-tooltip='Make Appointment'>Make</a>";
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
    <div class="row">
		<?php
		foreach ($allSpecialists as $specialist) {
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
</div>
