<?php
use HMS\Processor\{Site,Sessions};
?>
<nav class="navbar-extended">
    <div class="nav-wrapper">
        <div class="row valign-wrapper">
            <div class="col m9">

                <p class="brand-logo"><a href="<?php echo Site::getRoot();?>index.php">Hospital Self-Service Portal </a></p>
                <small class="">
                <?php
                if(Sessions::exists('loggedIn'))    echo "You are logged in as ".Sessions::get('user/username');
                else echo 'Please log in.';
                ?>
                    </small>

            </div>
            <div class="col m3 valign hide-on-med-and-down">
            <?php if(Sessions::exists('loggedIn')) echo '<a href="?logOut" class="waves-effect materialize-red waves-light btn  right logstatus">Log out</a>';?>
            </div>
        </div>
    </div>
<?php
if (Sessions::exists('loggedIn') && Sessions::get('user/type') !== 'Admin') {
            include 'nav-content.php';
}
?>
    </nav>