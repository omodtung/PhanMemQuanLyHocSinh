<?php


session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include_once "../../DB_connection.php";
        include_once "../DAL/data/schedule.php";
        include_once "../DAL/data/teacherAd.php";
        include_once "../DAL/data/class.php";
        include_once "../BL/data/class.php";
        include_once "../BL/data/teacher.php";
        include_once "../BL/data/schedule.php";

        $class = getAllClassBL($conn);
        $teachers = getAllTeachersBL($conn);
        $thissche = getScheduleFromBL($conn,$_GET["id"]);
        
        //$allsche = getAllSchedules($conn);


        function convertTimeToMinutes(string $timeString): int
        {
            // Split the time string into an array of hours, minutes, and seconds.
            $timeArray = explode(':', $timeString);

            // Convert the hours and seconds to minutes.
            $hoursInMinutes = (int) $timeArray[0] * 60;
            $secondsInMinutes = (int) $timeArray[2];

            // Calculate the total number of minutes in the time string.
            $totalMinutes = $hoursInMinutes + (int) $timeArray[1] + $secondsInMinutes;

            // Return the total number of minutes.
            return $totalMinutes;
        }
        // function cmp($a, $b) {
            
        //     return (convertTimeToMinutes($a->StartTime) < convertTimeToMinutes($b->StartTime)) ? -1 : 1;
        // }
        
        usort($thissche, function ($item1, $item2) {
            return convertTimeToMinutes($item1['StartTime']) <=> convertTimeToMinutes($item2['StartTime']);
        });
?>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="../css/style.css">
            <link rel="icon" href="../logo.png">

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <!-- using for date pick -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
            <link href="../plugins/noUiSlider-15.7.1/dist/nouislider.css" rel="stylesheet">
            <script src="../plugins/noUiSlider-15.7.1/dist/nouislider.js"></script>
            
            <!-- ------------------------date import code upper -->
        </head>

        <body>
            <?php
            //include_once "inc/navBar.php";
            ?>

            <div class="container mt-5 pb-3">
                <form method="post" class="shadow p-3 mt-2 form-w" action="#">

                    <div class="mb-3">

                        <div class="form-row">
                        <div class="table-responsive">
                        <table class="table table-success  n-table table-hover mx-auto align-middle table-striped-columns">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Time</th>
                                    <th scope="col">Thứ Hai</th>
                                    <th scope="col">Thứ Ba</th>
                                    <th scope="col">Thứ Tư</th>
                                    <th scope="col"> Thứ Năm </th>
                                    <th scope="col"> Thứ Sáu </th>
                                    <th scope="col"> Thứ Bảy </th>
                                    <th scope="col"> Chủ Nhật </th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            <?php foreach ($thissche as  $schedule) { ?>

                                <tr>
                                    <td><?= $schedule['StartTime'] ?> - <?= $schedule['EndTime'] ?></td>
                                    <td><?php echo ("Thứ Hai" == $schedule['WorkDate']) ? $schedule["Class"] : ''; ?></td>
                                    <td><?php echo ("Thứ Ba" == $schedule['WorkDate']) ? $schedule["Class"] : ''; ?></td>
                                    <td><?php echo ("Thứ Tư" == $schedule['WorkDate']) ? $schedule["Class"] : ''; ?></td>
                                    <td><?php echo ("Thứ Năm" == $schedule['WorkDate']) ? $schedule["Class"] : ''; ?></td>
                                    <td><?php echo ("Thứ Sáu" == $schedule['WorkDate']) ? $schedule["Class"] : ''; ?></td>
                                    <td><?php echo ("Thứ Bảy" == $schedule['WorkDate']) ? $schedule["Class"] : ''; ?></td>
                                    <td><?php echo ("Chủ Nhật" == $schedule['WorkDate']) ? $schedule["Class"] : ''; ?></td>

                                    
                                </tr>


                                <?php } ?>
                            </tbody>
                        </table>
                            
                        






                            <!-- <div class="position-relative pt-5">
                                
                                <button type="button" class="btn btn-primary position-absolute bottom-0 end-0" data-bs-dismiss="modal" id="Sucsessbtn" onclick="Save()">Close</button>
                            </div> -->
                        
                    </div>
                </form>

            </div>





        </body>

        </html>

    <?php } else { ?>

    <?php  } ?>

<?php } else { ?>

<?php } ?>