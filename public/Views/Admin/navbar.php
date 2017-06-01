<?php
use HMS\Processor\{
	Sessions, Site
};

use Carbon\Carbon;

?>

<!-- Main navbar -->
<div class="navbar navbar-default navbar-fixed-top header-highlight">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo Site::getRoot() ?>Views/Admin/index.php">ADMIN</a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a>
            </li>

        </ul>

        <div class="navbar-right">
            <p class="navbar-text text-capitalize"><?php
		        $time = Carbon::now(); ?>
		        <?php if ($time->hour < 12): ?>
                    Morning,
		        <?php elseif ($time->hour >= 12 && $time->hour < 17): ?>
                    Afternoon,
		        <?php elseif ($time->hour >= 17 && $time->hour < 19): ?>
                    Evening,
		        <?php endif ?>
		        <?php echo Sessions::get('user/username') ?></p>
            <p class="navbar-text"><span class="label bg-success">Online</span></p>

        </div>
    </div>
</div>
