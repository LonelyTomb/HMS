<?php

require "../../../vendor/autoload.php";

use HMS\Modules\Patient\Patient;
use HMS\Processor\{
	Auth, Site, Sessions
};


Auth::confirmLogin();
Auth::confirmType('patient');

$patient = new Patient();
$patient->resetApptCounter(Sessions::get('user/username'));
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
	<?php
	?>
</main>

<?php Site::reqAbs('Views/Parts/footer.php'); ?>

</body>

</html>