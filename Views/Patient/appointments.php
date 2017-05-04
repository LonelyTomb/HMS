<?php
    use HMS\Modules\Doctor\Doctor;
    use HMS\Modules\Doctor\Specialist;
    use HMS\Processor\Jasonify;

    $doctors = new Doctor();
    $allDoctors = $doctors->getDoctors();
    $specialists = new Specialist();
    $allSpecialists = $specialists->getSpecialists();
?>
    <div class="container hms_officials">
        <div class="row">
            <?php
    foreach($allDoctors as $doctor){
    echo '
            <div class="col l5 s10 doctor_outline">
                <div class="card">
                <div class="card-content">
                    <p class="doctorname"><h5>Doctor ';

    echo                  $doctor['Surname'];

    echo                '</h5></p>';

    $daysAvailable = Jasonify::toArray($doctor['DaysAvailable']);

    echo '      </div>
            <div class="card-action">';

    if($daysAvailable == ""){
        echo "Not Available";
    }else{
        foreach($daysAvailable as $day){
            echo "<span class='new badge cyan' data-badge-caption=''>$day</span>";
        }
    }
    echo '
    <p class="clearfix"></p>
                </div>
            </div>
            </div>
        ';
    }
    ?>

            <?php
    foreach($allSpecialists as $specialist){
    echo '
            <div class="col l5 s10 doctor-outline">
                <div class="card">
                <div class="card-content">
                    <p class="doctorname"><h5>Specialist ';

    echo                  $specialist['Surname'];

    echo                '</h5></p>';

    $daysAvailable = Jasonify::toArray($specialist['DaysAvailable']);

    echo '      </div>
            <div class="card-action">';

    if($daysAvailable == ""){
        echo "Not Available";
    }else{
        foreach($daysAvailable as $day){
            echo "<span class='new badge cyan' data-badge-caption=''>$day</span>";
        }
    }
    echo '    <p class="clearfix"></p>
                </div>
            </div>
            </div>
        ';
    }
    ?>
        </div>
    </div>