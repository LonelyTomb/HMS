<?php
namespace HMS\Views;

require "../../vendor/autoload.php";

use HMS\Processor\{Site,Sessions,Auth,Input};

// Sessions::init();
Auth::confirmLogin();
Auth::confirmType('Patient');
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php Site::pageTitle("Patient");Site::reqAbs('Views/Parts/head.php');?>
</head>
<body>
    <header>
<?php Site::reqAbs('Views/Parts/navbar.php');?>
    </header>
<main>
<?php
if(Input::getExists('appointment')){
    require 'appointments.php';
}
?>
</main>

<?php Site::reqAbs('Views/Parts/footer.php');?>

</body>

</html>