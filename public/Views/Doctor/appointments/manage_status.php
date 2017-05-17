<?php
use HMS\Modules\Doctor\Specialist;
use HMS\Modules\Doctor\Doctor;

use HMS\Processor\{
	Jasonify, Sessions, Input, Functions
};

if (Sessions::get('user/type') === 'doctor') {
	$doctor = new Doctor;
} elseif (Sessions::get('user/type') === 'specialist') {
	$doctor = new Specialist();
}
if (Input::exists()) {
	$status = Functions::escape(Input::catch ('status'));
	$daysAvailable = empty(Input::catch ('daysAvailable')) ? null : Jasonify::toJson(Input::catch ('daysAvailable'));
	$maxPatients = Functions::escape(Input::catch ('maxPatients'));

	if (Sessions::get('user/type') === 'doctor') {
		$noOfUpdates = $doctor->saveOptions(Sessions::get('user/username'), $status, $daysAvailable);
	} elseif (Sessions::get('user/type') === 'specialist') {
		$noOfUpdates = $doctor->saveOptions(Sessions::get('user/username'), $status, $maxPatients);
	}
	if ($noOfUpdates > 0) {
		Functions::toast('Success');
	} else {
		Functions::toast('No Changes Made');
	}

}
?>
<div class="col s12 m8">
    <h4 class="center-align">Manage Status</h4>
    <div class="card">
        <div class="card-panel">
            <form action="" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <div class="row">
                            <div class="switch col <?php echo Sessions::get('doctor') ? 's12' : 's8 l9'; ?>">
                                <label>
                                    Unavailable
                                    <input name='status' type='hidden' value='Unavailable'>
                                    <input type="checkbox" name="status" value="Available"
								        <?php if ($doctor->getStatusDb(Sessions::get('user/username'), Sessions::get('user/type')) === 'Available'):
									        ?>
                                            checked
								        <?php endif; ?>
                                    >
                                    <span class="lever"></span>
                                    Available
                                </label>
                            </div>
					        <?php if (Sessions::get('user/type') === 'specialist'): ?>
                                <span class="new badge brown col s4 l3"
                                      data-badge-caption="<?php echo $doctor->getAptCounter($doctor->getIdDb(Sessions::get('user/username'))); ?>">Days Available left: </span>
					        <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12 days-available">
				        <?php if (Sessions::get('user/type') === 'doctor'): ?>
                            <p>Days Available</p>
					        <?php
					        if ($doctor->getDaysAvailableDb(Sessions::get('user/username')) === null) {
						        echo '<p>Currently Not Set</p>';
					        } else {
						        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
						        $daysAvailable = Jasonify::toArray($doctor->getDaysAvailableDb(Sessions::get('user/username')));
						        foreach ($days as $day) {
							        echo '<p>';
							        echo "<input type='checkbox' id={$day} class='validate filled-in' name='daysAvailable[]' value='{$day}' ";
							        if (in_array($day, $daysAvailable, false)) {
								        echo 'checked';
							        }
							        echo '>';
							        echo "<label for={$day}>{$day}</label>";
							        echo '</p>';
						        }
					        }
					        ?>
				        <?php elseif (Sessions::get('user/type') === 'specialist'): ?>
                            <p>Maximum Patients Available to Specialist</p>
                            <div class="row">
                                <input type="text" name="maxPatients" id="maxPatients" class="validate col s7 m8 l9"
                                       name="maxPatients"
                                       value="<?php echo $doctor->getMaxPatientsDb(Sessions::get('user/username')); ?>"
                                       required>
                                <span class="new badge col s5 m4 l3 brown"
                                      data-badge-caption="<?php echo $doctor->getCurrentPatientsDb(Sessions::get('user/username')) ?>">Patients Attended: </span>
                            </div>

				        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" name="save" class="btn waves-effect waves-ripple cyan" value="save">
                </div>
            </form>
        </div>
    </div>

</div>