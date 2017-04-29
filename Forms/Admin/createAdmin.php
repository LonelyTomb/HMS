<?php
namespace HMS\Forms\Admin;

use HMS\Processor\{
	Input,Validator,Functions
};
use HMS\Modules\Admin\Admin;
;

if(Input::exists()){
	$validator = new Validator();
    $rules = array(
        'username'=>'required|min:4|unique:Users.username',
        'password'=>'required|min:4'
    );
    if($validator->validate($_POST,$rules)){
        $username = Functions::escape($_POST['username']);
        $password = Functions::escape($_POST['password']);
        $admin = new Admin($username,$password);
        $admin->createAdmin();
    }else{
        $error = $validator->getErrors();
        var_dump($error);

    }
}


?>
    <div class="container">
        <div class="card z-depth-3">
            <div class="card-content">
                <form action="" class="" method="POST">
                    <h3 class="flow-text left-align ">CREATE ADMIN</h3>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" id="username" class="validate" name="username" value="<?php echo Input::catch('username');
?>">
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