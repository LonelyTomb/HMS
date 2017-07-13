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
	<?php Site::setPageTitle('Admin'); ?>
    <title><?php Site::getPageTitle(); ?></title>
    <?php Site::reqAbs('Views/Admin/head.php');?>

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
                        }elseif(Input::getExists('createAdmin')){
                            echo 'Create Admin';
                        }
                            ?></h4>
                    </div>
                </div>

                <div class="breadcrumb-line breadcrumb-line-component">
                    <ul class="breadcrumb">
                        <li><a href="index.php"><i class="icon-home2 position-left"></i> Home</a></li>
                        <li class="active">Starters</li>

                    </ul>

                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

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