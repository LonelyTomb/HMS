<?php
use HMS\Processor\{
	Site, Sessions, Functions
};

?>
<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="category-content">
                <div class="sidebar-user-material-content">
                    <a href="#" class="media-left"><img
                                src="<?php echo Site::getRoot(); ?>Views/Admin/assets/images/image.png"
                                class="img-circle img-responsive"
                                alt=""></a>
                    <h6><?php echo Sessions::get('user/username'); ?></h6>
                </div>

                <div class="sidebar-user-material-menu">
                    <a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
                </div>
            </div>

            <div class="navigation-wrapper collapse" id="user-nav">
                <ul class="navigation">
                    <li><a href="#"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-cog5"></i> <span>Account settings</span></a></li>
                    <li><a href="?logOut"><i class="icon-switch2"></i> <span>Logout</span></a></li>
                </ul>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li><a href="<?php echo Site::getRoot() ?>Views/Admin/index.php"><i class="icon-home4"></i> <span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-database-add"></i> <span>Create</span></a>
                        <ul>
                            <li class="<?php Functions::toggleActive('createAdmin'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/create/?createAdmin'; ?>>Create
                                    Admin</a></li>
                            <li class="<?php Functions::toggleActive('createPatient'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/create/?createPatient'; ?>>Create
                                    Patient</a></li>
                            <li class="<?php Functions::toggleActive('createDoctor'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/create/?createDoctor'; ?>>Create
                                    Doctor</a></li>
                            <li class="<?php Functions::toggleActive('createSpecialist'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/create/?createSpecialist'; ?>>Create
                                    Specialist</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-database-edit2"></i> <span>Edit</span></a>
                        <ul>
                            <li class="<?php Functions::toggleActive('editAdmin'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/edit/?editAdmin'; ?>>Edit
                                    Admin</a>
                            </li>
                            <li class="<?php Functions::toggleActive('editPatient'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/edit/?editPatient'; ?>>Edit
                                    Patient</a></li>
                            <li class="<?php Functions::toggleActive('editDoctor'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/edit/?editDoctor'; ?>>Edit
                                    Doctor</a>
                            </li>
                            <li class="<?php Functions::toggleActive('editSpecialist'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/edit/?editSpecialist'; ?>>Edit
                                    Specialist</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-database-menu"></i> <span>View</span></a>
                        <ul>
                            <li class="<?php Functions::toggleActive('viewAdmin'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/view/?viewAdmin'; ?>>View
                                    Admin</a>
                            </li>
                            <li class="<?php Functions::toggleActive('viewPatient'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/view/?viewPatient'; ?>>View
                                    Patient</a></li>
                            <li class="<?php Functions::toggleActive('viewDoctor'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/view/?viewDoctor'; ?>>View
                                    Doctor</a>
                            </li>
                            <li class="<?php Functions::toggleActive('viewSpecialist'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/create/?createSpecialist'; ?>>View
                                    Specialist</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-database-remove"></i> <span>Delete</span></a>
                        <ul>
                            <li class="<?php Functions::toggleActive('deleteAdmin'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/delete/?deleteAdmin'; ?>>Delete
                                    Admin</a></li>
                            <li class="<?php Functions::toggleActive('deletePatient'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/delete/?deletePatient'; ?>>Delete
                                    Patient</a></li>
                            <li class="<?php Functions::toggleActive('deleteDoctor'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/delete/?deleteDoctor'; ?>>Delete
                                    Doctor</a></li>
                            <li class="<?php Functions::toggleActive('deleteSpecialist'); ?>"><a
                                        href=<?php echo Site::getRoot() . 'Views/Admin/delete/?deleteSpecialist'; ?>>Delete
                                    Specialist</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>