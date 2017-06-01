<?php

require '../../../vendor/autoload.php';


use HMS\Modules\Admin\Admin;
use HMS\Processor\{
	Auth, Site, Sessions, Input, Functions
};
use Carbon\Carbon;
Auth::confirmLogin();
Auth::confirmType('admin');

$admin = new Admin();
$adminDetails = $admin->getUserFromDb(Sessions::get('user/username'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php Site::setPageTitle('Admin'); ?>
    <title><?php Site::getPageTitle(); ?></title>
	<?php require __DIR__ . '/head.php'; ?>

</head>
<body class="navbar-top">
<!-- Main navbar -->
<?php
require __DIR__ . '/navbar.php';
?>

<!-- /Main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
		<?php require __DIR__ . '/sidebar.php'; ?>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><?php
							if (!Input::exists('get')) {
								echo 'Dashboard';
							}
	                        if (Input::getExists('createAdmin')) {
		                        echo 'Create Admin';
	                        } elseif (Input::getExists('createPatient')) {
		                        echo 'Create Patient';
	                        } elseif (Input::getExists('createDoctor')) {
		                        echo 'Create Doctor';
	                        } elseif (Input::getExists('createSpecialist')) {
		                        echo 'Create Specialist';
	                        }
							?></h4>
                    </div>
                </div>

                <div class="breadcrumb-line breadcrumb-line-component">
                    <ul class="breadcrumb">
                        <li><a href="index.php"><i class="icon-home2 position-left"></i> Home</a></li>
                        <li class="active">Dashboard</li>

                    </ul>

                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <!-- Footer -->
				<?php
				require __DIR__ . '/footer.php';
				?>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>