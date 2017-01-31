<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link href="css/materialize.css" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
</head>

<body>
    <?php require('header.php');?>
    <div class="row form_div">
        <div class="col m6 l5">
            <div class="card">
                <div class="card-content">
                    <form class="">
                        <h3 class="flow-text left-align ">LOGIN</h3>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" id="username" class="validate">
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 input-field">
                                <input type="password" id="password" class="validate">
                                <label for="Password">Password</label>
                            </div>
                        </div>
                        <a href="" class="btn waves-effect waves-light enter pink l2">Enter</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require('footer.php');?>

</body>

</html>