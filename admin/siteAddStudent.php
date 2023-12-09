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
        include_once "BL/data/subject.php";
        include_once "BL/data/grade.php";
        include_once "BL/data/student.php";
        include_once "BL/data/class.php";

        $subjects = getAllSubjectsBL($conn);
        $grades = getAllGradeBL($conn);
        $students = getAllStudentsBL($conn);
        $classes = getAllClassBL($conn);


        $id = '';

        $flname = '';
        $diaChi = '';
        $mahocsinh = '';

        $uname = '';

        // $pass = '';
        // $flname = '';
        // $lopChuNhiem = '';


        // if (isset($_GET['fname'])) $fname =  $_GET['fname'];

        // if (isset($_GET['lname'])) $lname  = $_GET['lname'];

        // if (isset($_GET['uname'])) $uname = $_GET['uname'];


?>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="../css/style.css">
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
                <a href="studentUI.php" class="btn btn-outline-primary btn_add_teacher">Back</a>

                <form method="post" class="shadow p-3 mt-5 form-w" action="BL/addStudent.php">
                    <h3> Form Thêm Học Sinh</h3>
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

                                    Full Name
                                </label>
                                <input type="text" class="form-control" placeholder="Đỗ Thế Tùng" name="flname" value="<?= $flname ?>">
                            </div>
                            <div class="col">
                                <label class="form-lable">

                                    User Name
                                </label>
                                <input type="text" class="form-control" placeholder="tungdo" name="uname" value="<?= $uname ?>">

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label class="form-lable">

                                    Mã Hoc Sinh
                                </label>
                                <input type="text" class="form-control" placeholder="HS001" name="maHocSinh" value="<?= $mahocsinh ?>">
                            </div>

                            <!-- <div class="col">
                                <label class="form-lable">

                                     ID
                                </label>
                                <input type="number" class="form-control" placeholder="example:tungdo" name="id" value="<?= $id ?>">
                            </div> -->



                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label class="form-lable">

                                    Địa Chỉ
                                </label>
                                <input type="text" class="form-control" placeholder="Ấp Nhân Hòa Thành Phố Biên Hòa Đồng Nai" name="diaChi" value="<?= $diaChi ?>">
                            </div>
                            <div class="col">

                                <label class="form-lable">

                                    PassWord
                                </label>
                                <input type="text" class="form-control" name="pass" id="passInput">
                            </div>
                        </div>









                        <!-- chon BirthDate -->
                        <!-- <div class="form-row"> -->


                        <div style="">

                            <div>
                                <label class="form-lable">

                                    BirthDate
                                </label>

                                <div class="row form-group">

                                    <label for="date" class="col-sm-1 col-form-label"></label>

                                    <div class="input-group date" id="datepicker">
                                        <input type="text" class="form-control" name="birthdate">
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-white">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>




                                </div>







                            </div>
                            <script type="text/javascript">
                                $(function() {
                                    $('#datepicker').datepicker();
                                });
                            </script>
                            <!-- chon Gioi Tinh -->




                            <div >



                                <label class="form-lable">

                                    Gioi Tinh
                                </label>

                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">

                                    <input type="radio" class="btn-check" name="genderbtn" value="Nam" id="btnradio1">
                                    <label class="btn btn-outline-primary rounded ms-5" for="btnradio1">Nam</label>

                                    <input type="radio" class="btn-check" name="genderbtn" value="Nữ" id="btnradio2">
                                    <label class="btn btn-outline-primary rounded ms-2" for="btnradio2">Nu</label>

                                </div>






                            </div>
                            <!-- </div> -->



                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">Hanh Kiem</label>
                                    <select class="form-select" aria-label="Default select example" name="hanhkiem">

                                        <option selected value="kha">Kha</option>
                                        <option value="tot">Tot</option>
                                        <option value="tb">Trung Binh</option>
                                    </select>



                                </div>

                                <!-- <div class="col-md-3">
                                    <label class="form-label">Hoc Luc</label>
                                    <select class="form-select" aria-label="Default select example" name="hocluc">


                                        <option selected value="gioi">Gioi</option>
                                        <option value="Tien Tien">TienTien</option>
                                        <option value="Trung binh">TrungBinh</option>
                                    </select>



                                </div> -->

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
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label"> Lop</label>
                                    <select name="classes" class="form-select" aria-label="Default select example">
                                        <?php foreach ($classes as $class) : ?>


                                            <option value="<?= $class['classname'] ?>"> <?= $class['classname'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>


                            </div>




                        </div>
                        <div style="text-align: right;">
                            <button type="submit" class="btn btn-primary">Save Change</button>


                        </div>
                </form>
            </div>
        </body>

        </html>

    <?php } else { ?>

    <?php  } ?>

<?php } else { ?>

<?php } ?>