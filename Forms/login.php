<?php
use HMS\Processor\Input;
use HMS\Processor\Validator;
use HMS\Processor\Jasonify;

if(Input::exists()){
    $validator = new Validator();
    $validation = $validator->validate($_POST,array (
        'username'=> array (
            'required'=>true,
            'min'=>4,
            'max'=>20
        )
    ));

    if($validation->getPassed()){
    }else{
        $error = $validation->getErrors();
        $error = array_pop($error);
        echo "<script>Materialize.toast('{$error}',4000)</script>";

    }
}

?>

<div class="row form_div">
        <div class="col m6 l5">
            <div class="card z-depth-3">
                <div class="card-content">
                    <form action="" class="" method="POST">
                        <h3 class="flow-text left-align ">LOGIN</h3>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" id="username" class="validate" name="username" value="<?php echo Input::get('username');?>">
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 input-field">
                                <input type="password" id="password" class="validate" name="password">
                                <label for="Password">Password</label>
                            </div>
                        </div>
                        <button type="submit" class="btn waves-effect waves-ripple waves-teal waves-light enter pink l2">Enter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>