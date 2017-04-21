<?php
use \HMS\Processor\Site;
?>
<title><?php Site::getPageTitle();?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo Site::getRoot();?>fonts/iconfont/material-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo Site::getRoot();?>css/app.css">