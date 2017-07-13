<?php
/**
 * Created by PhpStorm.
 * User: lonelytomb
 * Date: 7/13/17
 * Time: 1:27 AM
 */
use HMS\Processor\{
	Input, Validator,User,Functions
};

if (Input::exists()) {
	$validator = new Validator();
	$rules = [
		"username" => "required|min:2",
		"email" => "required|email",
		"password" => "required|min:4"
	];
	if ($validator->validate($_POST, $rules)) {
			$username = Input::catch("username");
			$email = Input::catch("email");
			$password = Input::catch("password");

			$user = new User();
			if($user->resetPassword($username,$email,$password)){
				Functions::toast("Success");
			}else{
				Functions::toast("Error: Unable to reset Password");
			}
	}
}
?>
<div class="row form_div">
	<div class="col m6 l5">
		<div class="card z-depth-3">
			<div class="card-title">
				<h1 class="flow-text center-align ">Reset Password</h1>
			</div>
			<div class="card-content">
				<form action="" class="" method="POST" id="form-reset">

					<div class="row">
						<div class="input-field col s12">
							<input type="text" id="username" class="validate" name="username"
							       value="<?php echo Input::catch ('username'); ?>">
							<label for="username">Username</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input type="email" id="email" class="validate" name="email"
							       value="<?php echo Input::catch ('email'); ?>">
							<label for="email">Email</label>
						</div>
					</div>
					<div class="row">
						<div class="col s12 input-field">
							<input type="password" id="password" class="validate" name="password" value="<?php echo Input::catch ('password'); ?>">
							<label for="password">Enter New Password</label>
						</div>
					</div>
				</form>
			</div>
			<div class="card-action">
				<button type="submit" form="form-reset"
				        class="btn waves-effect waves-ripple waves-teal waves-light enter pink l2">
					Enter
				</button>
			</div>
		</div>
	</div>
</div>
