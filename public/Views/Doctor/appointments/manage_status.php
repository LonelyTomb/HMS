<?php
use HMS\Modules\Doctor\Specialist;
use HMS\Modules\Doctor\Doctor;

use HMS\Processor\Sessions;

if (Sessions::get('user/type') === 'doctor') {
	$doctor = new Doctor;
} elseif (Sessions::get('user/type') === 'specialist') {
	$doctor = new Specialist();
}
?>
<div class="col s12 m8">
    <h4 class="center-align">Manage Status</h4>
    <div class="card">
        <div class="card-panel">
            <form action="">
                <div class="form-group">
                    <div class="switch">
                        <label>
                            Unavailable
                            <input type="checkbox"
								<?php if ($doctor->getStatusDb(Sessions::get('user/username'), Sessions::get('user/type')) === 'Available'):
									?>
                                    checked
								<?php endif; ?>
                            >
                            <span class="lever"></span>
                            Available
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>