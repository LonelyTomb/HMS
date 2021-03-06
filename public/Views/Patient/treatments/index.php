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

<main class="treatments row">
</main>

<?php Site::reqAbs('Views/Parts/footer.php'); ?>

</body>

</html>