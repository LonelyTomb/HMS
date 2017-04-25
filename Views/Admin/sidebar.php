<?php
namespace HMS\Views\Admin;

use HMS\Processor\Site;
?>
    <ul id="slide-out" class="side-nav fixed sideBar col s6 m4 l3">
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header">Create User<i class="material-icons">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="?createAdmin">Admin</a></li>
                            <li><a href="<?php echo Site::getRoot();?>">Patient</a></li>
                            <li><a href="<?php echo Site::getRoot();?>">Doctor</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header">Edit User<i class="material-icons">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="<?php echo Site::getRoot();?>">Admin</a></li>
                            <li><a href="<?php echo Site::getRoot();?>">Patient</a></li>
                            <li><a href="<?php echo Site::getRoot();?>">Doctor</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
    </ul>