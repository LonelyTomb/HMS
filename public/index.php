<?php
require "../vendor/autoload.php";

use HMS\Processor\{
	Auth, Site, Input
};

Auth::loginBySession();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php Site::setPageTitle('HMS');
	Site::reqAbs('Views/Parts/head.php');
	?>
</head>
<body>
<header>
	<?php require 'Views/Parts/navbar.php';
	?>
</header>
<main>
	<p class="clearfix"></p>
	<?php
	if (!Input::exists('get')) {
		include 'Forms/login.php';
	} elseif (Input::getExists('reset')) {
		include "Forms/reset.php";
	} elseif (Input::getExists('register') && Input::getExists('patient')) {
		include 'Forms/patient/registerAsPatient.php';
	} elseif (Input::getExists('register') && Input::getExists('specialist')) {
		include 'Forms/doctor/registerAsSpecialist.php';
	} elseif (Input::getExists('register') && Input::getExists('doctor')) {
		include 'Forms/doctor/registerAsDoctor.php';
	}

	?>
</main>

<?php require 'Views/Parts/footer.php';
?>


</body>

</html>