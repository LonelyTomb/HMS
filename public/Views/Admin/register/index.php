<?php
/**
 * Created by PhpStorm.
 * User: lonelytomb
 * Date: 7/13/17
 * Time: 3:51 AM
 */

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
	<?php Site::setPageTitle('Register Modules -- Admin'); ?>
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

	<!--    Editable Forms JS files-->
	<script type="text/javascript"
	        src="<?php echo Site::getRoot(); ?>Views/Admin/assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script type="text/javascript"
	        src="<?php echo Site::getRoot(); ?>Views/Admin/assets/js/plugins/extensions/mockjax.min.js"></script>
	<script type="text/javascript"
	        src="
	<?php echo Site::getRoot(); ?>Views/Admin/assets/js/plugins/forms/editable/editable.min.js"></script>
	<script type="text/javascript"
	        src="
	<?php echo Site::getRoot(); ?>Views/Admin/assets/js/pages/form_editable.js"></script>
	/ Editable Forms JS files
	<script type="text/javascript"
	        src="<?php echo Site::getRoot(); ?>Views/Admin/assets/js/plugins/forms/styling/switchery.min.js"></script>

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
							} elseif (Input::getExists('registerPatient')) {
								echo 'Register  Pending Patients';
							} elseif (Input::getExists('registerDoctor')) {
								echo 'Register  Pending Doctors';
							} elseif (Input::getExists('registerSpecialist')) {
								echo 'Register  Pending Specialists';
							}
							?></h4>
					</div>
				</div>

				<div class="breadcrumb-line breadcrumb-line-component">
					<ul class="breadcrumb">
						<li><a href="index.php"><i class="icon-home2 position-left"></i> Home</a></li>
						<li><a href="index.php">Edit</a></li>
						<li class="active">
							<?php
							if (Input::getExists('registerPatient')) {
								echo 'Register Pending Patients';
							} elseif (Input::getExists('registerDoctor')) {
								echo 'Register Pending Doctors';
							} elseif (Input::getExists('registerSpecialist')) {
								echo 'Register Pending Specialists';
							}
							?></li>

					</ul>

				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">


				<?php
				if (Input::getExists('registerPatient')) {
					Site::reqAbs('Forms/patient/registerPatient.php');

				} elseif (Input::getExists('registerDoctor')) {
					Site::reqAbs('Forms/doctor/registerDoctor.php');

				} elseif (Input::getExists('registerSpecialist')) {
					Site::reqAbs('Forms/doctor/registerSpecialist.php');

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