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
				<!-- Sitemap -->
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Sitemap</h5>
					</div>

					<div class="panel-body">
						<div class="row">
							<div class="col-sm-6 col-lg-3">
								<div class="content-group">
									<h6 class="text-semibold">Create Module</h6>
									<ul class="list list-unstyled">
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/create/?createAdmin'; ?>">Create
												Admin</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/create/?createPatient'; ?>">Create
												Patient</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/create/?createDoctor'; ?>">Create
												Doctor</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/create/?createSpecialist'; ?>">Create
												Specialist</a></li>


									</ul>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="content-group">
									<h6 class="text-semibold">Register Module</h6>
									<ul class="list list-unstyled">

											<a href="<?php echo Site::getRoot() . 'Views/Admin/register/?registerPatient'; ?>">Register
												Patient</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/register/?registerDoctor'; ?>">Register
												Doctor</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/register/?registerSpecialist'; ?>">Register
												Specialist</a></li>


									</ul>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="content-group">
									<h6 class="text-semibold">Edit Module</h6>
									<ul class="list list-unstyled">
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/edit/?editAdmin'; ?>">Edit
												Admin</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/edit/?editPatient'; ?>">Edit
												Patient</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/edit/?editDoctor'; ?>">Edit
												Doctor</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/edit/?editSpecialist'; ?>">Edit
												Specialist</a></li>
									</ul>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="content-group">
									<h6 class="text-semibold">View Module</h6>
									<ul class="list list-unstyled">
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/view/?viewAdmin'; ?>">View
												Admin</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/view/?viewPatient'; ?>">View
												Patient</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/view/?viewDoctor'; ?>">View
												Doctor</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/view/?viewSpecialist'; ?>">View
												Specialist</a></li>
									</ul>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="content-group">
									<h6 class="text-semibold">Delete Module</h6>
									<ul class="list list-unstyled">
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/delete/?deleteAdmin'; ?>">Delete
												Admin</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/delete/?deletePatient'; ?>">Delete
												Patient</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/delete/?deleteDoctor'; ?>">Delete
												Doctor</a></li>
										<li>
											<a href="<?php echo Site::getRoot() . 'Views/Admin/delete/?deleteSpecialist'; ?>">Delete
												Specialist</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /sitemap -->
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