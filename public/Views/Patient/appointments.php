<?php
use HMS\Modules\Doctor\{
	Doctor, Specialist
};

use HMS\Modules\Patient\Patient;
use HMS\Processor\{
	Jasonify, Functions, Sessions, Site
};

$doctors = new Doctor();
$allDoctors = $doctors->getDoctors();

$specialists = new Specialist();
$allSpecialists = $specialists->getSpecialists();
$patient = new Patient();
$patientId = $patient->getId(Sessions::get('user/username'));

$patient->makeAppointment();

?>
<div class="container hms_officials">
    <div class="row">
		<?php
		foreach ($allDoctors as $doctor) {
			$docId = $doctors->getId($doctor['DoctorId']);
			echo '
            <div class="col l5 s10 doctor_outline">
                <div class="card">
                <div class="card-content">
                    <p class="name"><h5>Doctor ';

			echo $doctor['Surname'];

			echo '</h5></p>';

			$daysAvailable = Jasonify::toArray($doctor['DaysAvailable']);

			echo '</div>
            <div class="card-action">';

			if ($daysAvailable == "") {
				echo "<p>Not Available</p>";
			} else {
				echo "<a href='?make&id={$patientId}&type=doctors&docId={$docId}' class='waves waves-ripple red btn' data-position='bottom' data-delay='50' data-tooltip='Make Appointment'>Make</a>";
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

		<?php
		foreach ($allSpecialists as $specialist) {
			$speId = $specialists->getId($specialist['SpecialistId']);
			echo '
            <div class="col l5 s10 specialist_outline">
                <div class="card">
                <div class="card-content">
                    <p class="name">
                        <h5>Specialist ';

			echo $specialist['Surname'];

			echo '        </h5>
                    </p>';

			$status = $specialist['Status'];

			echo '      </div>
            <div class="card-action">';

			if ($status == "Unavailable") {
				echo "<p>Not Available</p>";
			} else {
				echo "<a href='?make&id={$patientId}&type=specialists&docId={$speId}' class='waves waves-ripple red btn' data-position='bottom' data-delay='50' data-tooltip='Make Appointment'>Make</a>";
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
