<?php
use HMS\Processor\{
	Auth, Input
};

if (Input::exists()) {
	Auth::logIn($_POST);
}

?>

<div class="row form_div">
	<div class="col m6 l5">
		<div class="card z-depth-3">
			<div class="card-title">
				<h1 class="flow-text center-align ">LOGIN</h1>
			</div>
			<div class="card-content">
				<form action="" class="" method="POST" id="form-login">

					<div class="row">
						<div class="input-field col s12">
							<input type="text" id="username" class="validate" name="username"
							       value="<?php echo Input::catch ('username'); ?>">
							<label for="username">Username</label>
						</div>
					</div>
					<div class="row">
						<div class="col s12 input-field">
							<input type="password" id="password" class="validate" name="password">
							<label for="password">Password</label>
						</div>
					</div>


				</form>
			</div>
			<div class="card-action">
				<button type="submit" form="form-login" class="btn waves-effect waves-ripple waves-teal waves-light enter pink l2">
					Enter
				</button>

				<a href="#" class="dropdown-button btn waves-effect cyan right"
				   data-activates="register">Register <i class="material-icons right">send</i></a>
				<ul id="register" class="dropdown-content">
					<li><a href="?register&patient">As Patient</a></li>
					<li><a href="?register&doctor">As Doctor</a></li>
					<li><a href="?register&specialist">As Specialist</a></li>
				</ul>
			</div>
		</div>
		<a href="?reset" class="btn waves-effect red waves-ripple right">Reset Password</a>
	</div>
</div>