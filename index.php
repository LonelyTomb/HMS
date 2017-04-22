<?php
namespace HMS;

require "vendor/autoload.php";

use HMS\Processor\Site;

?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php Site::pageTitle('HMS');require 'Views/Parts/head.php';?>
</head>
<?php require 'Views/Parts/header.php' ;?>
<main>
    <p class="clearfix"></p>
    <?php
        require 'Forms/login.php';
    ?>
</main>

<?php require 'Views/Parts/footer.php' ;?>

<body>

</body>

</html>