<?php


session_start();

// print_r($_SESSION);
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include_once "../DB_connection.php";
        include_once "DAL/data/subject.php";
        include_once "DAL/data/grade.php";
        include_once "DAL/data/student.php";
        include_once "DAL/data/class.php";
        include_once "BL/data/grade.php";
        include_once "BL/data/subject.php";
        include_once "BL/data/student.php";
        include_once "BL/data/class.php";

        $subjects = getAllSubjectsBL($conn);
        $grades = getAllGradeBL($conn);
        $students = getAllStudentsBL($conn);
        $classes = getAllClassBL($conn);




        $nameClass ='';
        
        $idclass =  '';

        $idnamhoc= '';
        // $pass = '';
        // $flname = '';
        // $lopChuNhiem = '';


        if (isset($_GET['nameClass'])) $nameClass =  $_GET['nameClass'];

        if (isset($_GET['idclass'])) $idclass =  $_GET['idclass'];


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

            <!-- ------------------------date import code upper -->
        </head>

        <body>
            <?php
            include_once "inc/navBar.php";
            ?>

            <div class="container mt-5">
                <a href="teacherUI.php" class="btn btn-outline-primary btn_add_teacher">Back</a>

                <form method="post" class="shadow p-3 mt-5 form-w" action="BL/addClass.php">
                    <h3> Site ADD class</h3>
                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert danger" role="alert">
                            <?= $_GET['error'] ?>

                        </div>



                    <?php } ?>


                    <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success" role="alert">

                            <?= $_GET['success'] ?>
                        </div>

                    <?php } ?>
                    <div class="mb-3">

                        <div class="form-row">
                            <div class="col">
                                <label class="form-lable">

                                 Ma Khối
                                </label>
                                <input type="text" class="form-control" placeholder="example Tung" value="<?= $nameClass ?>" name="nameClass">
                            </div>
                         
                        </div>
                       

                       
                        <div class="form-row">
                            <div class="col">
                                <label class="form-lable">

                                 ClassName
                                </label>
                                <input type="text" class="form-control" placeholder="example Tung" value="<?= $idclass ?>" name="idclass">
                            </div>
                         
                        </div>


                        <div class="form-row">
                            <div class="col">
                                <label class="form-lable">

                                Mã Năm Học
                                </label>
                                <input type="text" class="form-control" placeholder="example Tung" value="<?= $idnamhoc ?>" name="idnamhoc">
                            </div>
                         
                        </div>
                        <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label"> Khoi Hoc</label>
                                    <select name="grades" class="form-select" aria-label="Default select example">
                                        <?php foreach ($grades as $grade) : ?>


                                            <option value="<?= $grade['grade_id'] ?>"> <?= $grade['grade_code'] ?>-<?= $grade['grade'] ?></option>
                                            <?php endforeach ?>0
                                    </select>
                                </div>

                            </div>
                    </div>




                        <button type="submit" class="btn btn-primary">Save Change</button>
                </form>
            </div>
        </body>

        </html>

    <?php } else { ?>

    <?php  } ?>

<?php } else { ?>

<?php } ?>