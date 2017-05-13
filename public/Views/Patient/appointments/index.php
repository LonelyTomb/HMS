<?php
require "../../../../vendor/autoload.php";

use HMS\Processor\{
	Site, Auth, Input
};

use Carbon\Carbon;

Auth::confirmLogin();
Auth::confirmType('patient');


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php Site::pageTitle('Appointments');
	Site::reqAbs('Views/Parts/head.php'); ?>
</head>
<body>
<header>
	<?php Site::reqAbs('Views/Parts/navbar.php'); ?>
</header>
<main class="appointments">
    <div class="row">
		<?php
		require __DIR__ . '/sidebar.php';

		if (Input::getExists('doctors') || Input::getExists('make')) {
			require __DIR__ . '/doctors.php';
		} elseif (Input::getExists('specialists') || Input::getExists('make')) {
			require __DIR__ . '/specialists.php';
		} elseif (Input::getExists('ongoing')) {
			require __DIR__ . '/ongoingAppointments.php';
		}
		?>
    </div>
</main>

<?php Site::reqAbs('Views/Parts/footer.php'); ?>

</body>

</html>