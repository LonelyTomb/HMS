<?php

require '../../../vendor/autoload.php';

use HMS\Processor\{Site,Sessions,Auth};

// Sessions::init();
Auth::confirmLogin();
Auth::confirmType('Doctor');
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php Site::pageTitle("Doctor");Site::reqAbs('Views/Parts/head.php');?>
</head>
<body>
    <header>
<?php Site::reqAbs('Views/Parts/navbar.php');?>
    </header>
<main>

</main>

<?php Site::reqAbs('Views/Parts/footer.php');?>



</body>

</html>