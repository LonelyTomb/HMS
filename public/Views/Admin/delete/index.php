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
	<?php Site::setPageTitle('Delete Modules -- Admin'); ?>
    <title><?php Site::getPageTitle(); ?></title>
    <?php Site::reqAbs('Views/Admin/head.php');?>

	<!--    Data Tables JS files-->
	<script type="text/javascript"
	        src="<?php echo Site::getRoot(); ?>Views/Admin/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript"
	        src="<?php echo Site::getRoot(); ?>Views/Admin/assets/js/pages/datatables_extension_select.js"></script>
	<script type="text/javascript"
	        src="<?php echo Site::getRoot(); ?>Views/Admin/assets/js/pages/datatables_basic.js"></script>
	<!-- /   Data Tables JS files-->

	<style>
		.datatable-scroll,.datatable-basic{
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
        <?php Site::reqAbs('Views/Admin/sidebar.php');?>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><?php
                        if(!Input::exists('get')){
                            echo 'Dashboard';
                        }elseif(Input::getExists('deleteAdmin')){
                            echo 'Delete Admin';
                        }elseif(Input::getExists('deleteDoctor')){
	                        echo 'Delete Doctor';
                        }elseif(Input::getExists('deletePatient')){
	                        echo 'Delete Patient';
                        }elseif(Input::getExists('deleteSpecialist')){
	                        echo 'Delete Specialist';
                        }
                            ?></h4>
                    </div>
                </div>

                <div class="breadcrumb-line breadcrumb-line-component">
                    <ul class="breadcrumb">
	                    <li><a href="index.php"><i class="icon-home2 position-left"></i> Home</a></li>
	                    <li><a href="index.php">Delete</a></li>
	                    <li class="active">
		                    <?php
		                    if (Input::getExists('deleteAdmin')) {
			                    echo 'Delete Admin';
		                    } elseif (Input::getExists('deletePatient')) {
			                    echo 'Delete Patient';
		                    } elseif (Input::getExists('deleteDoctor')) {
			                    echo 'Delete Doctor';
		                    } elseif (Input::getExists('deleteSpecialist')) {
			                    echo 'Delete Specialist';
		                    }
		                    ?></li>

                    </ul>

                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">
	            <?php
	            if (Input::getExists('deleteAdmin')) {
		            Site::reqAbs('Forms/admin/deleteAdmin.php');
	            } elseif (Input::getExists('deletePatient')) {
		            Site::reqAbs('Forms/patient/deletePatient.php');

	            } elseif (Input::getExists('deleteDoctor')) {
		            Site::reqAbs('Forms/doctor/deleteDoctor.php');

	            } elseif (Input::getExists('deleteSpecialist')) {
		            Site::reqAbs('Forms/doctor/deleteSpecialist.php');

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