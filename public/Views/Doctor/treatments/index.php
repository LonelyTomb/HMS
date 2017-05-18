<?php
require "../../../../vendor/autoload.php";

use HMS\Modules\Patient\Patient;
use HMS\Modules\Doctor\Doctor;
use HMS\Processor\{
	Sessions, Site, Auth, Input, HMSPaginator
};

Auth::confirmLogin();
$patient = new Patient();
$doctor = new Doctor();

$paginator = new HMSPaginator($doctor->getAllConfirmedAppt(Sessions::get('user/username'), Sessions::get('user/type')), 'appointments', 1);
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
    <div class="col s12">
		<?php
		foreach ($paginator->getPagination()->getItems() as $treatments) {


			echo '<div class="card" >
              <div class="card-content" > ';

			echo '</div>
                </div>';
		}
		?>
    </div>
    <p class="clearfix"></p>
	<?php
	echo $paginator->getPageUrl();
	?>
</main>

<?php Site::reqAbs('Views/Parts/footer.php'); ?>
</body>

</html>