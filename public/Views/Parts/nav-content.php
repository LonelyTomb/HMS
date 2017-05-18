<?php
use HMS\Processor\{
	Sessions, Site, Functions
};

$type = Sessions::get('user/type') === 'patient' ? ucfirst(Sessions::get('user/type')) : 'Doctor';
?>
<div class="nav-content brown">
    <div class="row">
        <a href="#" data-activates="mobile-nav" class="button-collapse ">
            <i class="material-icons">menu</i>
        </a>
        <ul class="hide-on-med-and-down left">
            <li>
                <a href="<?php echo Site::getRoot() ?>index.php"><i class="material-icons left">home</i>Home</a>
            </li>
            <!--<li>
					<a href="#"><i class="material-icons left">thumb_up</i>Authorization</a>
				</li>-->
            <li>
                <a href="<?php echo Site::getRoot(); ?>Views/<?php echo $type ?>/appointments/"><i
                            class="material-icons left">today</i>Appointment</a>
            </li>
            <li>
                <a href="#"><i class="material-icons left">person</i>Client/Enrollee Details</a>
            </li>
            <li>
                <a href="<?php echo Site::getRoot(); ?>Views/<?php echo $type ?>/treatments/"><i
                            class="material-icons left">local_hospital</i>Treatment</a>
            </li>
            <li>
                <a href="#"><i class="material-icons left">sms_failed</i>Feedback</a>
            </li>
        </ul>
		<?php if (Sessions::exists('loggedIn')): ?>
            <a href="?logOut"
               class="waves-effect materialize-red waves-light btn  right hide-on-large-only show-on-small">Log Out</a>
		<?php endif; ?>
    </div>
</div>
<ul class="side-nav" id="mobile-nav">
    <li>
        <a href="<?php echo Site::getRoot() ?>index.php"><i class="material-icons left">home</i>Home</a>
    </li>
    <!--<li>
			<a href="#"><i class="material-icons left">thumb_up</i>Authorization</a>
		</li>-->
    <li>
        <a href="<?php echo Site::getRoot(); ?>Views/<?php echo $type ?>/appointments/?appointments"><i
                    class="material-icons left">today</i>Appointment</a>
    </li>
    <li>
        <a href="#"><i class="material-icons left">person</i>Client/Enrollee Details</a>
    </li>
    <li>
        <a href="<?php echo Site::getRoot(); ?>Views/<?php echo $type ?>/treatments/"><i class="material-icons left">local_hospital</i>Treatment</a>
    </li>
    <li>
        <a href="#"><i class="material-icons left">sms_failed</i>Feedback</a>
    </li>

</ul>
