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
        $thissche = getScheduleBL($conn,$_GET["id"]);

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
                <form method="post" class="shadow p-3 mt-2 form-w" action="BL/schedule-edit.php?id=<?=$_GET["id"] ?>">

                    <div class="mb-3">

                        <div class="form-row">
                            <div class="col">
                                <label class="form-lable">

                                    Teacher Select
                                </label>
                                <select name="teacherid" class="form-select">
                                    <?php foreach ($teachers as $teacher) : ?>
                                        <option value="<?= $teacher['id'] ?>" <?php echo ($teacher['id'] == $thissche['TeacherId']) ? 'selected' : ''; ?>><?= $teacher['hoten'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-row pt-3">
                            <div class="col">
                                <label class="form-lable">

                                    Work Time
                                </label>
                                <div id=container class="ps-3 pe-3 pt-1">
                                    <div id=slider></div>
                                
                                </div>
                                <div class="d-inline">
                                    <div class="d-inline" id="leftvalue" >
                                    
                                </div>
                                <input type="text" name="starttime" id="stinput" style="display:none;">
                                    <div class="d-inline float-end" id="rightvalue" name="endtime"></div>
                                    <input type="text" name="endtime" id="etinput" style="display:none;">
                                </div>
                                
                            </div>
                            <script src="../js/converttime.js"></script>
                            <script>
                                var slider = document.getElementById("slider"),
                                leftValue = document.getElementById('leftvalue'),
                                rightValue = document.getElementById('rightvalue'),
                                startvalue = document.getElementById('stinput'),
                                endvalue = document.getElementById('etinput');
                            // 0 = initial minutes from start of day
                            // 1440 = maximum minutes in a day
                            // step: 30 = amount of minutes to step by. 
                            var initialStartMinute = 0,
                                    initialEndMinute = 1440,
                                    Margin = 45,
                                    step = 5;
                                
                            slider = noUiSlider.create(slider,{
                            start:[convertTimeToMinutes("<?php Print($thissche["StartTime"]); ?>"),convertTimeToMinutes("<?php Print($thissche["EndTime"]); ?>")],
                            connect:true,
                            step:step,
                            margin: Margin,
                            
                            range:{
                                'min':initialStartMinute,
                                'max':initialEndMinute
                            }
                            });

                            var convertValuesToTime = function(values,handle){
                            var hours = 0,
                                    minutes = 0;
                                
                            if(handle === 0){
                                hours = convertToHour(values[0]);
                                minutes = convertToMinute(values[0],hours);
                                leftValue.innerHTML = formatHoursAndMinutes(hours,minutes);
                                startvalue.value = formatHoursAndMinutes(hours,minutes);
                                return;
                            };
                            
                            hours = convertToHour(values[1]);
                            minutes = convertToMinute(values[1],hours);
                                rightValue.innerHTML = formatHoursAndMinutes(hours,minutes);
                                endvalue.value = formatHoursAndMinutes(hours,minutes);
                            };

                            var convertToHour = function(value){
                                return Math.floor(value / 60);
                            };
                            var convertToMinute = function(value,hour){
                                return value - hour * 60;
                            };
                            var formatHoursAndMinutes = function(hours,minutes){
                                    if(hours.toString().length == 1) hours = '0' + hours;
                                if(minutes.toString().length == 1) minutes = '0' + minutes;
                                return hours+':'+minutes;
                            };

                            slider.on('update',function(values,handle){
                            convertValuesToTime(values,handle);
                            });

                            </script>
                        </div>
                        <div class="form-row pt-3">
                            <div class="col">
                                <label class="form-lable">

                                    Work Date
                                </label>
                                
                                
                                
                            
                            <div class="btn-group" role="group" style="flex-wrap: wrap;">
                                <input type="radio" class="btn-check" name="workdate" value="Thứ Hai" id="btnradio1" autocomplete="off" <?php echo ("Thứ Hai" == $thissche['WorkDate']) ? 'checked' : ''; ?>>
                                <label class="btn btn-outline-primary rounded ms-1" for="btnradio1">Thứ Hai</label>
                                <input type="radio" class="btn-check" name="workdate" value="Thứ Ba" id="btnradio2" autocomplete="off" <?php echo ("Thứ Ba" == $thissche['WorkDate']) ? 'checked' : ''; ?>>
                                <label class="btn btn-outline-primary rounded ms-1" for="btnradio2">Thứ Ba</label>
                                <input type="radio" class="btn-check" name="workdate" value="Thứ Tư" id="btnradio3" autocomplete="off" <?php echo ("Thứ Tư" == $thissche['WorkDate']) ? 'checked' : ''; ?>>
                                <label class="btn btn-outline-primary rounded ms-1" for="btnradio3">Thứ Tư</label>
                                <input type="radio" class="btn-check" name="workdate" value="Thứ Năm" id="btnradio4" autocomplete="off" <?php echo ("Thứ Năm" == $thissche['WorkDate']) ? 'checked' : ''; ?>>
                                <label class="btn btn-outline-primary rounded ms-1" for="btnradio4">Thứ Năm</label>
                                <input type="radio" class="btn-check" name="workdate" value="Thứ Sáu" id="btnradio5" autocomplete="off" <?php echo ("Thứ Sáu" == $thissche['WorkDate']) ? 'checked' : ''; ?>>
                                <label class="btn btn-outline-primary rounded ms-1" for="btnradio5">Thứ Sáu</label>
                                <input type="radio" class="btn-check" name="workdate" value="Thứ Bảy" id="btnradio6" autocomplete="off" <?php echo ("Thứ Bảy" == $thissche['WorkDate']) ? 'checked' : ''; ?>>
                                <label class="btn btn-outline-primary rounded ms-1" for="btnradio6">Thứ Bảy</label>
                                <input type="radio" class="btn-check" name="workdate" value="Chủ Nhật" id="btnradio7" autocomplete="off" <?php echo ("Chủ Nhật" == $thissche['WorkDate']) ? 'checked' : ''; ?>>
                                <label class="btn btn-outline-primary rounded ms-1" for="btnradio7">Chủ Nhật</label>
                            </div>
                            </div>
                        </div>
                        <div class="form-row pt-3">
                            <div class="col">
                                <label class="form-lable">

                                    Class
                                </label>
                                <select name="class" class="form-select">
                                    <?php foreach ($class as $cls) : ?>
                                        <option value="<?= $cls['classname'] ?>" <?php echo ($cls["classname"] == $thissche['Class']) ? 'selected' : ''; ?>><?= $cls['classname'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            
                        </div>






                            <div class="position-relative pt-5">
                                
                                <button type="submit" class="btn btn-primary position-absolute bottom-0 end-0" data-bs-dismiss="modal" id="Sucsessbtn" onclick="Save()">Save</button>
                            </div>
                        
                    </div>
                </form>

            </div>





        </body>

        </html>

    <?php } else { ?>

    <?php  } ?>

<?php } else { ?>

<?php } ?>