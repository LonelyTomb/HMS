<?php
namespace HMS\Views;

require $_SERVER['DOCUMENT_ROOT']."/labs/HMS/vendor/autoload.php";

use HMS\Processor\Site;
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php Site::pageTitle("Doctor");Site::reqAbs('Views/Parts/head.php');?>
</head>
<?php Site::reqAbs('Views/Parts/header.php');?>
<main>

</main>

<?php Site::reqAbs('Views/Parts/footer.php');?>

<body>

</body>

</html>