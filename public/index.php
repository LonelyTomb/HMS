<?php
require "../vendor/autoload.php";

use HMS\Processor\{
	Auth, Site
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
	require 'Forms/login.php';

	?>
</main>

<?php require 'Views/Parts/footer.php';
?>


</body>

</html>