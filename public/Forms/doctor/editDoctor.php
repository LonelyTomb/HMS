<?php
use HMS\Processor\{
	Validator, Sessions, Functions, Input,Jasonify,Errors
};
use HMS\Modules\Doctor\Doctor;

$doctors = new Doctor();
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
        $doctorId = Functions::escape(Input::catch ('doctorId'));
		$surname = Functions::escape(Input::catch ('surname'));
		$otherNames = Functions::escape(Input::catch ('otherNames'));
		$email = Functions::escape(Input::catch ('email'));
		$phoneNumber = Functions::escape(Input::catch ('phoneNumber'));
		$gender = Functions::escape(Input::catch ('gender'));
		$status = Functions::escape(Input::catch ('status'));
		$address = Functions::escape(Input::catch ('address'));
		$doctor = new Doctor();
		$doctor->updateDoctor($doctorId,$surname, $otherNames, $gender, $address, $phoneNumber, $email, $status);
		Functions::jGrowl(['message' => 'Success', 'theme' => 'bg-success alert-styled-right alert-arrow-right']);
	} else {
		Errors::allErrors($validator->getErrors(), 'jGrowl');
	}
}

?>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">View Registered Doctors</h5>
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
                    <th>Doctor Id</th>
                    <th>Surname</th>
                    <th>Other Names</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Email Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach ($doctors->getDoctors() as $doctor): ?>

                    <tr>
                        <form action="" class="form form-vertical" method="POST" id="<?php echo $doctor['id'] ?>">
                            <td><?php echo ++$count; ?></td>
                            <td>
                                <div class="form-group">
                                    <span class=""><?php echo $doctor['doctorId'] ?></span>
                                    <input type="hidden" name="doctorId" value="<?php echo $doctor['doctorId'] ?>"
                                           class="form-control disabled">
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $doctor['surname'] ?></span>
                                    <input type="text" name="surname" value="<?php echo $doctor['surname'] ?>"
                                           class="form-control">
                                </div>
                            </td>


                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $doctor['otherNames'] ?></span>
                                    <input type="text" name="otherNames" value="<?php echo $doctor['otherNames'] ?>"
                                           class="form-control">
                                </div>
                            </td>


                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $doctor['gender'] ?></span>
                                    <input type="text" name="gender" value="<?php echo $doctor['gender'] ?>"
                                           class="form-control">
                                </div>
                            </td>


                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $doctor['address'] ?></span>
                                    <input type="text" name="address" value="<?php echo $doctor['address'] ?>"
                                           class="form-control">
                                </div>
                            </td>


                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $doctor['phoneNumber'] ?></span>
                                    <input type="text" name="phoneNumber" value="<?php echo $doctor['phoneNumber'] ?>"
                                           class="form-control">
                                </div>
                            </td>


                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $doctor['email'] ?></span>
                                    <input type="text" name="email" value="<?php echo $doctor['email'] ?>"
                                           class="form-control">
                                </div>
                            </td>


                            <td>
                                <div class="form-group">
                                    <span class="hidden"><?php echo $doctor['status'] ?></span>
                                    <input type="text" name="status" value="<?php echo $doctor['status'] ?>"
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