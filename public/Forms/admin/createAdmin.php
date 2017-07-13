<?php

use HMS\Processor\{
	Input, Validator, Functions, Errors
};
use HMS\Modules\Admin\Admin;


if (Input::exists()) {
	$validator = new Validator();
	$rules = array(
		'username' => 'required|min:4|unique:users.username',
		'password' => 'required|min:4'
	);
	if ($validator->validate($_POST, $rules)) {
		$username = Functions::escape(Input::catch ('username'));
		$password = Functions::escape(Input::catch ('password'));
		$admin = new Admin();
		$admin->createAdmin($username, $password);
		Functions::jGrowl(['message' => 'Success', 'theme' => 'bg-success alert-styled-right alert-arrow-right']);
	} else {
		Errors::allErrors($validator->getErrors(), 'jGrowl');

	}
}
?>
<div class="panel panel-bordered panel-primary">
    <div class="panel-heading">
        <h3 class="text-bold panel-title">Admin Registeration Form</h3>
    </div>
    <div class="panel-body">
        <form action="" class="form form-horizontal" method="post" id="regForm">
            <div class="form-group">
                <label for="username" class="control-label col-sm-2">Username</label>
                <div class="col-sm-8">
                    <div class="row">
                        <input type="text" class="form-control" id="username" placeholder="Please Enter Username"
                               name="username" value="<?php echo Input::catch ('username'); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="control-label col-sm-2">Password</label>
                <div class="col-sm-8">
                    <div class="row">
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Please Enter Password" value="<?php echo Input::catch ('password'); ?>">
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="panel-footer">
        <div class="heading-elements">
            <div class="heading-btn pull-right">
                <button type="submit" class="btn btn-success legitRipple" form="regForm">Submit<i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
    </div>
</div>