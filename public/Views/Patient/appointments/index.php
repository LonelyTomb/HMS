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
	<?php Site::setPageTitle('Appointments');
	Site::reqAbs('Views/Parts/head.php'); ?>
</head>
<body>
<header>
	<?php Site::reqAbs('Views/Parts/navbar.php'); ?>
</header>

<main class="appointments row">
    <!--    <div class="row">-->
	<?php
	require __DIR__ . '/sidebar.php';

	if (Input::getExists('type')) {
		if (Input::catch ('type') === 'doctor'):
			require __DIR__ . '/doctors.php';
        elseif (Input::catch ('type') === 'specialist'):
			require __DIR__ . '/specialists.php';
		endif;
	} elseif (Input::getExists('ongoing') || Input::exists('get') === false) {
		require __DIR__ . '/ongoingAppointments.php';
	}
	?>
    <!--    </div>-->
</main>

<?php Site::reqAbs('Views/Parts/footer.php'); ?>

</body>

</html>