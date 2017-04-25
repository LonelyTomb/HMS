<?php
namespace HMS\Views;

require "../../vendor/autoload.php";

use HMS\Processor\Site;
use HMS\Processor\Sessions;

Sessions::init();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php Site::pageTitle("Doctor");Site::reqAbs('Views/Parts/head.php');?>
</head>
<body>
    <header>
<?php Site::reqAbs('Views/Parts/publicNav.php');?>
    </header>
<main>

</main>

<?php Site::reqAbs('Views/Parts/footer.php');?>



</body>

</html>