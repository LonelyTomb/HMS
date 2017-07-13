<?php
use HMS\Processor\{
	Validator, Sessions, Functions, Input,Jasonify,Errors
};
use HMS\Modules\Doctor\Specialist;

$specialists = new Specialist();
$count = 0;
if (Input::exists()) {
	$validator = new Validator();
	$rules = [
		'surname' => 'required|min:2',
		'otherNames' => 'required|min:2',
		'email' => 'required|min:4',
		'phoneNumber' => 'required|max:11',
		'address' => 'required',
		'gender' => 'required'
	];
	if ($validator->validate($_POST, $rules)) {
        $specialistId = Functions::escape(Input::catch ('specialistId'));
		$surname = Functions::escape(Input::catch ('surname'));
		$otherNames = Functions::escape(Input::catch ('otherNames'));
        $specialization = Functions::escape(Input::catch ('specialization'));
		$email = Functions::escape(Input::catch ('email'));
		$phoneNumber = Functions::escape(Input::catch ('phoneNumber'));
		$gender = Functions::escape(Input::catch ('gender'));
		$status = Functions::escape(Input::catch ('status'));
		$address = Functions::escape(Input::catch ('address'));
    	$maxPatients = Functions::escape(Input::catch ('maxPatients'));
		$specialist = new Specialist();
		$specialist->updateSpecialist($specialistId,$surname, $otherNames, $gender, $address, $phoneNumber, $email, $maxPatients);
		Functions::jGrowl(['message' => 'Success', 'theme' => 'bg-success alert-styled-right alert-arrow-right']);
	} else {
		Errors::allErrors($validator->getErrors(), 'jGrowl');
	}
}

?>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">View Registered specialists</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <form action="" method="post" id="form">
            <table class="table datatable-basic table-bordered table-striped table-hover datatable-responsive">
                <thead>
                <tr>
                   <th>No</th>
                <th>Specialist Id</th>
                <th>Surname</th>
                <th>Other Names</th>
	                <th>Specialization</th>
                <th>Gender</th>

                <th>Address</th>
                <th>Phone Number</th>
                <th>Email Address</th>
                <th>Max Patients</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach ($specialists->getSpecialists() as $specialist): ?>

                    <tr>
                        <form action="" class="form form-vertical" method="POST" id="<?php echo $specialist['id'] ?>">
                            <td><?php echo ++$count; ?></td>
                            <td>
                                <div class="form-group">
                                    <span class=""><?php echo $specialist['specialistId'] ?></span>
                                    <input type="hidden" name="specialistId" value="<?php echo $specialist['specialistId'] ?>"
                                           class="form-control disabled">
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $specialist['surname'] ?></span>
                                    <input type="text" name="surname" value="<?php echo $specialist['surname'] ?>"
                                           class="form-control">
                                </div>
                            </td>


                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $specialist['otherNames'] ?></span>
                                    <input type="text" name="otherNames" value="<?php echo $specialist['otherNames'] ?>"
                                           class="form-control">
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $specialist['specialization'] ?></span>
                                    <input type="text" name="specialization" value="<?php echo $specialist['specialization'] ?>"
                                           class="form-control">
                                </div>
                            </td>


                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $specialist['gender'] ?></span>
                                    <input type="text" name="gender" value="<?php echo $specialist['gender'] ?>"
                                           class="form-control">
                                </div>
                            </td>


                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $specialist['address'] ?></span>
                                    <input type="text" name="address" value="<?php echo $specialist['address'] ?>"
                                           class="form-control">
                                </div>
                            </td>


                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $specialist['phoneNumber'] ?></span>
                                    <input type="text" name="phoneNumber" value="<?php echo $specialist['phoneNumber'] ?>"
                                           class="form-control">
                                </div>
                            </td>


                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $specialist['email'] ?></span>
                                    <input type="text" name="email" value="<?php echo $specialist['email'] ?>"
                                           class="form-control">
                                </div>
                            </td>

  <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $specialist['maxPatients'] ?></span>
                                    <input type="text" name="maxPatients" value="<?php echo $specialist['maxPatients'] ?>"
                                           class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $specialist['status'] ?></span>
                                    <input type="text" name="status" value="<?php echo $specialist['status'] ?>"
                                           class="form-control">
                                </div>
                            </td>
                            <td>
                            <button class="btn btn-primary" name="submit">Submit</button>
                            </td>
                        </form>
                    </tr>
				<?php endforeach; ?>
                </tbody>

            </table>
        </form>
    </div>
</div>
<script>

</script>


