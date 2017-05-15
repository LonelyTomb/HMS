<?php
require "../../../../vendor/autoload.php";

use HMS\Processor\{
	Site, Auth, Input
};

use Carbon\Carbon;

Auth::confirmLogin();


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
<main class="appointments row">
		<?php
		require __DIR__ . '/sidebar.php';

		if (Input::getExists('appointments')) {
			require __DIR__ . '/appointments.php';
		} elseif (Input::getExists('status')) {
			require __DIR__ . '/manage_status.php';
		}
		?>

</main>

<?php Site::reqAbs('Views/Parts/footer.php'); ?>

</body>

</html>