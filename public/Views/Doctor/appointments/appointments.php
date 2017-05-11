<?php
use HMS\Modules\Doctor\Doctor;
use HMS\Modules\Patient\Patient;
use HMS\Processor\Sessions;
use Carbon\Carbon;

$doctor = new Doctor();
$patient = new Patient();

$allAppointments = $doctor->getAllAppointments(Sessions::get('user/username'), Sessions::get('user/type'));
?>

<div class="col s12 m8">
    <h4 class="center-align">Ongoing Appointments</h4>
    <div class="row">
		<?php
		foreach ($allAppointments as $appointment) {
			$patientType = $patient->getUserTypeDb($appointment['patientId']);
			$patientName = $patient->getSurnameDb($appointment['patientId'], $patientType);
			$appointmentDate = new Carbon($appointment['appointmentDate']);

			echo '<div class="col s10  m6 appointment">
<div class="card">
<div class="card-content">';

			echo "<p class='doctor_name'>{$patientType}: $patientName </p>";
			echo "<p class='date'>Date Made: {$appointmentDate->toDayDateTimeString()}</p>";
			echo "<p class='center-align'><a href='#' class=' waves waves-ripple cyan btn'>Begin Treatment</a></p>";

			echo '</div>
          </div>
        </div>';
		}
		?>
    </div>
</div>
