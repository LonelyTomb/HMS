<?php
namespace HMS\Views\Admin;

require '../../vendor/autoload.php';


use HMS\Processor\{Auth,Site,Sessions,Input,Functions};

// Sessions::init();
Auth::confirmLogin();
Auth::confirmType('Admin');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php Site::pageTitle("Admin");Site::reqAbs('Views/Parts/head.php');?>
    </head>

    <body>
        <header>
            <?php Site::reqAbs('Views/Parts/adminNav.php');?>
        </header>
        <main>
            <div class="row">
            <?php require 'sidebar.php';?>
            <div class="col s6 m8 l9">
            <?php
            if(Input::getExists('createAdmin')){
                Site::reqAbs('Forms/Admin/createAdmin.php');
            }
            elseif(Input::getExists('createDoctor')){
                Site::reqAbs('Forms/doctor/createDoctor.php');
            }
            elseif(Input::getExists('createSpecialist')){
                Site::reqAbs('Forms/doctor/createSpecialist.php');
            }
            elseif(Input::getExists('createPatient')){
                Site::reqAbs('Forms/patient/createPatient.php');
            }
            ?>
            </div>
        </div>
        </main>

        <?php Site::reqAbs('Views/Parts/footer.php');?>



    </body>

    </html>