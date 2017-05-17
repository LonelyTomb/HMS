<?php
use HMS\Modules\Doctor\Doctor;
use HMS\Modules\Patient\Patient;
use HMS\Processor\{
	Sessions, HMSPaginator
};
use Carbon\Carbon;

$patient = new Patient();

$paginator = new HMSPaginator($patient->getAllAppointments(Sessions::get('user/username'), Sessions::get('user/type')), 'ongoing', 1);
$doctor = new Doctor();

?>


    <div class="col s12 m8 ">
        <h4 class="center-align">Ongoing Appointments</h4>
        <div class="row">
			<?php
			foreach ($paginator->getPagination()->getItems() as $appointment) {
				$doctorType = $doctor->getUserTypeDb($appointment['doctorId']);
				$doctorName = $doctor->getSurnameDb($appointment['doctorId'], $doctorType);

				$appointmentDate = new Carbon($appointment['appointment_date']);

				echo '<div class="col s10  m6 appointment">
                        <div class="card">
                        <div class="card-content">';
				echo "<p class='doctor_name'>{$doctorType}: $doctorName </p>";
				echo "<p class='date'>Date Made: {$appointmentDate->toDayDateTimeString()}</p>";
				if ($appointment['status'] === 'Unconfirmed') {
					echo "<div class='center-align'><a href='#' class='disabled waves waves-ripple cyan btn'>Unconfirmed</a></div>";
				} elseif ($appointment['status'] === 'Confirmed') {
					echo "<div class='center-align'><a href='#' class=' waves waves-ripple cyan btn'>View</a></div>";
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