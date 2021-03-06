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
	<?php Site::setPageTitle('Admin - Edit Modules'); ?>
    <title><?php Site::getPageTitle(); ?></title>

	<?php Site::reqAbs('Views/Admin/head.php'); ?>


    <!--    Data Tables JS files-->
    <script type="text/javascript"
            src="<?php echo Site::getRoot(); ?>Views/Admin/assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript"
            src="<?php echo Site::getRoot(); ?>Views/Admin/assets/js/pages/datatables_extension_select.js"></script>
    <script type="text/javascript"
            src="<?php echo Site::getRoot(); ?>Views/Admin/assets/js/pages/datatables_basic.js"></script>
    <!-- /   Data Tables JS files-->

    <style>
        .datatable-scroll{
            width: 100%;
            overflow-x: scroll;
        }
    </style>
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
							} elseif (Input::getExists('viewAdmin')) {
								echo 'View Admin';
							} elseif (Input::getExists('viewPatient')) {
								echo 'View Patient';
							} elseif (Input::getExists('viewDoctor')) {
								echo 'View Doctor';
							} elseif (Input::getExists('viewSpecialist')) {
								echo 'View Specialist';
							}
							?></h4>
                    </div>
                </div>

                <div class="breadcrumb-line breadcrumb-line-component">
                    <ul class="breadcrumb">
                        <li><a href="index.php"><i class="icon-home2 position-left"></i> Home</a></li>
                        <li><a href="index.php">View</a></li>
                        <li class="active">
							<?php
							if (Input::getExists('viewAdmin')) {
								echo 'View Admin';
							} elseif (Input::getExists('viewPatient')) {
								echo 'View Patient';
							} elseif (Input::getExists('viewDoctor')) {
								echo 'View Doctor';
							} elseif (Input::getExists('viewSpecialist')) {
								echo 'View Specialist';
							}
							?></li>

                    </ul>

                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">


				<?php
				if (Input::getExists('viewAdmin')) {
					Site::reqAbs('Forms/admin/viewAdmin.php');
				} elseif (Input::getExists('viewPatient')) {
					Site::reqAbs('Forms/patient/viewPatient.php');

				} elseif (Input::getExists('viewDoctor')) {
					Site::reqAbs('Forms/doctor/viewDoctor.php');

				} elseif (Input::getExists('viewSpecialist')) {
					Site::reqAbs('Forms/doctor/viewSpecialist.php');

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