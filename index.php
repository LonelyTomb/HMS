<?php
namespace HMS;

require "vendor/autoload.php";

use HMS\Processor\{
	Site,Sessions,Input,Functions,Auth
}
;

?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php Site::pageTitle('HMS');
Site::reqAbs('Views/Parts/head.php');
?>
</head>
<body>
    <header>
<?php require 'Views/Parts/navbar.php' ;
?>
    </header>
<main>
    <p class="clearfix"></p>
    <?php
require 'Forms/login.php';

?>
</main>

<?php require 'Views/Parts/footer.php' ;
?>



</body>

</html>