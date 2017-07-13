<?php

require "../../../vendor/autoload.php";

use HMS\Modules\Patient\Patient;
use HMS\Modules\Doctor\Doctor;
use HMS\Processor\{
	Auth, Site, Sessions, Input,HMSPaginator
};
use Carbon\Carbon;
Auth::confirmLogin();
Auth::confirmType('patient');

$patient = new Patient();
$patient->resetApptCounter(Sessions::get('user/username'));
$paginator = new HMSPaginator($patient->getAllAppointments(Sessions::get('user/username'), Sessions::get('user/type')), 'ongoing', 2);
$doctor = new Doctor();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php Site::setPageTitle('Patient');
	Site::reqAbs('Views/Parts/head.php'); ?>
</head>
<body>
<header>
	<?php Site::reqAbs('Views/Parts/navbar.php'); ?>
</header>
<main>



    <div class="col s12 m8 ">
        <h4 class="center-align">Recent Appointments</h4>
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
					echo "<div class='center-align'></div>";
				}

				echo '</div>
</div>
</div>';
			}
			?>
        </div>

    </div>
</main>

<?php Site::reqAbs('Views/Parts/footer.php'); ?>

</body>

</html>