<?php

require '../../../vendor/autoload.php';

use HMS\Processor\{
	Auth, Site
};

Auth::confirmLogin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	Site::pageTitle('Doctor');
	Site::reqAbs('Views/Parts/head.php'); ?>
</head>
<body>
<header>
	<?php Site::reqAbs('Views/Parts/navbar.php'); ?>
</header>
<main>

</main>

<?php Site::reqAbs('Views/Parts/footer.php'); ?>


</body>

</html>