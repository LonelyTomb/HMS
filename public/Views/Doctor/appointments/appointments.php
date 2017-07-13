<?php
use HMS\Modules\Doctor\Doctor;
use HMS\Modules\Patient\Patient;
use HMS\Processor\{
	HMSPaginator, Sessions, Functions, Input
};
use Carbon\Carbon;

$doctor = new Doctor();
$patient = new Patient();

if (Input::getExists('confirm')) {
	$patient->confirmAppointment(Input::catch ('appointments'), Input::catch ('patient'), Sessions::get('user/username'));
}

$paginator = new HMSPaginator($doctor->getAllAppointments(Sessions::get('user/username'), Sessions::get('user/type')), 'appointments', 1);
?>

<div class="col s12 m8">
    <h4 class="center-align">Ongoing Appointments</h4>
    <div class="row">
		<?php
		foreach ($paginator->getPagination()->getItems() as $appointment) {
			$patientName = $patient->getSurnameDb($appointment['patientId'], 'patient');
			$appointmentDate = new Carbon($appointment['appointment_date']);

			echo '<div class="col s10  m6 appointment">
                    <div class="card">
                    <div class="card-content">';

			echo "<p class='doctor_name'>Patient: $patientName </p>";
			echo "<p class='date'>Date Made: {$appointmentDate->toDayDateTimeString()}</p>";
			if ($appointment['status'] === 'Unconfirmed') {
				echo "<div class='center-align action-block'><a href='?appointments={$appointment['id']}&confirm&patient={$patient->getIdDb($appointment['patientId'])}' class=' waves waves-ripple red btn'>Confirm</a></div>";
			} elseif ($appointment['status'] === 'Confirmed') {
				echo "<div class='center-align action-block'><a href='#' class=' waves waves-ripple cyan btn'>View Treatment</a></div>";
			}

			echo '</div>
          </div>
        </div>';
		}
		?>
    </div>
</div>

<p class="clearfix"></p>
<?php
echo $paginator->getPageUrl();
?>
