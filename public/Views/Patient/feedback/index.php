<?php
require "../../../../vendor/autoload.php";

use HMS\Processor\{
	Site, Auth, Input, Validator, Sessions, Functions, Jasonify,Errors,Mail
};

use Carbon\Carbon;

Auth::confirmLogin();
use HMS\Modules\Patient\Patient;


if (Input::exists()) {
	$validator = new Validator();
	$rules = [
		'feedback' => 'required',
		'subject' => 'required',
		
	];
	if ($validator->validate($_POST, $rules)) {
		$feedback = Functions::escape(Input::catch ('feedback'));
		$subject = Functions::escape(Input::catch ('subject'));
		$name = Sessions::get('user/username');
		$user = new Patient();
		$address = $user->getDetail(Sessions::get('user/username'),Sessions::get('user/type'))['email'];
		
		Mail::send($name, $address, $subject, $feedback);
		Functions::redirect('Views/Patient/feedback/');
		Functions::toast('Success');

		// Sessions::flash('Registration msg', '<p>Registration Successful.</p><p>Please Check inbox to view login details after registration details are confirmed</p>');
	} else {
		Errors::allErrors($validator->getErrors(), 'jGrowl');
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php Site::setPageTitle('Feedback');
	Site::reqAbs('Views/Parts/head.php'); ?>
</head>
<body>
<header>
	<?php Site::reqAbs('Views/Parts/navbar.php'); ?>
</header>

<main class="details row">
<p><h4 class="center-align">Send Feedback To Administrator</h4></p>

<form action="" method="post" id="form">

	<div class="row">
    <form class="col s12">
      <div class="row">
      	<div class="input-field col s6">
          <input placeholder="Subject" type="text" name="subject" class="validate">
          <label for="first_name">Subject</label>
        </div>
        <p></p>
        <div class="input-field col s12">
          <textarea class="materialize-textarea" name="feedback"></textarea>
          <label for="textarea1">Message</label>
        </div>
      </div>

      <button class="btn btn-primary" name="submit" type="submit">Send</button>
    </form>
  </div>

</form>

<?php Site::reqAbs('Views/Parts/footer.php'); ?>

</body>

</html>