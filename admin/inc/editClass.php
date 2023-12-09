<?php


session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include_once "../../DB_connection.php";
        include_once "../DAL/data/schedule.php";
        include_once "../DAL/data/teacherAd.php";
        include_once "../DAL/data/class.php";
        include_once "../BL/data/class.php";
        $class = getClassBL($conn,$_GET["id"]);
        

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
                <form method="post" class="shadow p-3 mt-2 form-w" action="BL/class-edit.php?id=<?=$_GET["id"] ?>">

                    <div class="mb-3">

                        <div class="form-row">
                            <div class="col">
                                <label class="form-lable">

                                 ClassName
                                </label>
                                <input type="text" class="form-control" placeholder="example Tung" value="<?= $class['classname'] ?>" name="nameClass">
                            </div>
                         
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label class="form-lable">

                                  Grade
                                </label>
                                <input type="text" class="form-control" placeholder="example Tung" value="<?= $class['makhoi'] ?>" name="makhoi">
                            </div>
                         
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label class="form-lable">

                                  Year
                                </label>
                                <input type="text" class="form-control" placeholder="example Tung" value="<?= $class['manamhoc'] ?>" name="manamhoc">
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