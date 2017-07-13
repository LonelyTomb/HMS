<?php

require '../../../../vendor/autoload.php';


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
	<?php Site::setPageTitle('Create Modules -- Admin'); ?>
    <title><?php Site::getPageTitle(); ?></title>
	<?php Site::reqAbs('Views/Admin/head.php'); ?>

</head>
<body class="navbar-top">
<!-- Main navbar -->
<?php
Site::reqAbs('Views/Admin/navbar.php');
?>

<!-- /Main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
		<?php Site::reqAbs('Views/Admin/sidebar.php'); ?>
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
							} elseif (Input::getExists('createAdmin')) {
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
                        <li><a href="index.php">Create</a></li>
                        <li class="active">
							<?php
							if (Input::getExists('createAdmin')) {
								echo 'Create Admin';
							} elseif (Input::getExists('createPatient')) {
								echo 'Create Patient';
							} elseif (Input::getExists('createDoctor')) {
								echo 'Create Doctor';
							} elseif (Input::getExists('createSpecialist')) {
								echo 'Create Specialist';
							}
							?></li>

                    </ul>

                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">


				<?php
				if (Input::getExists('createAdmin')) {
					Site::reqAbs('Forms/admin/createAdmin.php');
				} elseif (Input::getExists('createPatient')) {
					Site::reqAbs('Forms/patient/createPatient.php');

				} elseif (Input::getExists('createDoctor')) {
					Site::reqAbs('Forms/doctor/createDoctor.php');

				} elseif (Input::getExists('createSpecialist')) {
					Site::reqAbs('Forms/doctor/createSpecialist.php');

				}
				?>
                <!-- Footer -->
				<?php
				Site::reqAbs('Views/Admin/footer.php');
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