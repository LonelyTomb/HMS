<?php

require "../../../vendor/autoload.php";

use HMS\Processor\Site;
use HMS\Processor\Auth;


Auth::confirmLogin();
Auth::confirmType('patient');


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php Site::pageTitle("Patient");
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