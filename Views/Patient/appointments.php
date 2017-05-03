<?php
    use HMS\Modules\Doctor\Doctor;
    use HMS\Processor\Jasonify;

    $doctors = new Doctor();
    $allDoctors = $doctors->getDoctors();
?>
<div class="container">
    <div class="row">
    <?php
    foreach($allDoctors as $doctor){
    echo '
            <div class="col l5 s10">
                <div class="card">
                <div class="card-content">
                    <p class="doctorname"><h5>Doctor ';

    echo                  $doctor['Surname'];

    echo                '</h5></p>';

    $daysAvailable = Jasonify::toArray($doctor['DaysAvailable']);

    echo '      </div>
            <div class="card-action"><p class="daysAvailable">';

    if($daysAvailable == ""){
        echo "Not Available";
    }else{
        foreach($daysAvailable as $day){
            echo "<span class='new badge cyan' data-badge-caption=''>$day</span>";
        }
    }
    echo '    </p>
    <p class="clearfix"></p>
                </div>
            </div>
            </div>
        ';
    }
    ?>
    </div>
    </div>