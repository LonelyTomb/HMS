<?php
use HMS\Processor\Site;
?>

<nav class="navbar-extended">
        <div class="nav-wrapper">
            <div class="row valign-wrapper">
                <div class="col m9">

                    <p class="brand-logo"><a href="<?php echo Site::getRoot();?>index.php">Hospital Self-Service Portal </a></p>
                    <small class="">
                        You are logged in as Victory
                    </small>

                </div>
                <div class="col m3 valign hide-on-med-and-down">
                    <a href="" class="waves-effect waves-light btn  right logstatus">Log in</a>
                </div>
            </div>
        </div>
        <div class="nav-content">
            <div class="row">
                <a href="#" data-activates="mobile-nav" class="button-collapse ">
                    <i class="material-icons">menu</i>
                </a>
                <ul class="hide-on-med-and-down left">
                    <li>
                        <a href="#"><i class="material-icons left">home</i>Home</a>
                    </li>
                    <!--<li>
                        <a href="#"><i class="material-icons left">thumb_up</i>Authorization</a>
                    </li>-->
                    <li>
                        <a href="#"><i class="material-icons left">today</i>Appointment</a>
                    </li>
                    <li>
                        <a href="#"><i class="material-icons left">person</i>Client/Enrollee Details</a>
                    </li>
                    <li>
                        <a href="#"><i class="material-icons left">local_hospital</i>Treatment</a>
                    </li>
                    <li>
                        <a href="#"><i class="material-icons left">sms_failed</i>Feedback</a>
                    </li>
                </ul>
                <a href="" class="waves-effect waves-light btn  right hide-on-large-only show-on-small">Log in</a>
            </div>
        </div>
        <ul class="side-nav" id="mobile-nav">
            <li>
                <a href="#"><i class="material-icons left">home</i>Home</a>
            </li>
            <!--<li>
                <a href="#"><i class="material-icons left">thumb_up</i>Authorization</a>
            </li>-->
            <li>
                <a href="#"><i class="material-icons left">today</i>Appointment</a>
            </li>
            <li>
                <a href="#"><i class="material-icons left">person</i>Client/Enrollee Details</a>
            </li>
            <li>
                <a href="#"><i class="material-icons left">local_hospital</i>Treatment</a>
            </li>
            <li>
                <a href="#"><i class="material-icons left">sms_failed</i>Feedback</a>
            </li>

        </ul>
    </nav>