<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] = 'Admin') {
        include_once "../DB_connection.php";
        include_once "DAL/data/teacherAd.php";
        include_once "DAL/data/subject.php";
        include_once "DAL/data/grade.php";
        include_once "DAL/data/getteacher.php";

        $teachers =   getAllTeachers($conn);


        //print_r($teachers);

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Home - Su Pham Thuc Hanh High School</title>

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

            <link rel="icon" href="..logo.png">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
            <style>



            </style>
        </head>

        <body id="main-body">
            <?php
            include_once "inc/navBar.php";
            if ($teachers != 0) {


            ?>
                <div class="container mt-5">
                    <div class="sticky-top">
                        <a href="siteTeacherAdd.php" class="btn btn-outline-primary btn_add_teacher">Add New Teacher</a>
                        <a href="./DAL/encryptpasswords.php?table=teachers" class="btn btn-outline-primary btn_encrypt">Encrypt All Passwords</a>
                    </div>
                    <div class="table-responsive">
                        <!-- <table class="table table-success table-striped n-table"> -->
                        <table class="table table-striped">
                            <thead class="thead-dark" style="background-color:black; color:azure;">
                                <tr>

                                    <th scope="col">Teacher ID</th>
                                    <th scope="col">USER NAME</th>
                                    <th scope="col">PASSWORD</th>
                                    <th scope="col">Ho Ten</th>
                                    <th scope="col">Ma Mon Hoc</th>
                                    <!-- <th scope="col">Ma  khoi</th> -->
                                    <th scope="col"> ngay sinh</th>

                                    <th scope="col"> Gioi Tinh </th>
                                    <th scope="col"> Dia chi </th>
                                    <th scope="col"> Ma giao vien </th>
                                    <th scope="col">Ma khoi</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($teachers as  $teacher) { ?>

                                    <tr>
                                        <!-- <th scope="row">1</th> -->
                                        <td><?= $teacher['id'] ?></td>
                                        <td><?= $teacher['username'] ?></td>
                                        <td><?= $teacher['password'] ?></td>
                                        <td><?= $teacher['hoten'] ?></td>
                                        <td><?= $teacher['mamonhoc'] ?></td>
                                        <!-- <td><?= $teacher['makhoi'] ?></td> -->
                                        <td><?= $teacher['ngaysinh'] ?></td>
                                        <td><?= $teacher['gioitinh'] ?></td>
                                        <td><?= $teacher['diachi'] ?></td>
                                        <td><?= $teacher['magv'] ?></td>

                                        <!-- <td>
                                            <?php
                                            $s = '';
                                            $subjects  = str_split(trim($teacher['mamonhoc']));
                                            foreach ($subjects as $subject) {
                                                //  $s_temp = getSubjectById($subject, $conn);
                                                $s_temp = getSubjectBySubject_code($subject, $conn);
                                                if ($s_temp != 0) {
                                                    $s .= $s_temp['subject'] . ',';
                                                }
                                            }

                                            echo $s;
                                            ?>
                                        </td>  -->
                                        <td>
                                            <?php
                                            $g = '';
                                            $grades  = str_split(trim($teacher['makhoi']));
                                            foreach ($grades as $grade) {
                                                $s_temp = getGradeById($grade, $conn);

                                                if ($s_temp != 0) {
                                                    $g .= $s_temp['grade_code'] . ',';
                                                }
                                            }

                                            echo $g;
                                            ?>
                                        </td>

                                        <td>
                                            <!-- <a href="teacher-edit.php?idteach=<?= $teacher['id'] ?>" class="btn btn-warning">Edit</a> -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalform" onclick="btnclick('./inc/editTeacher.php?idteach=<?= $teacher['id'] ?>')" data-bs-id=<?= $teacher['id'] ?>>
                                                Edit
                                            </button>
                                            <a href="" class="btn btn-danger">Delete</a>




                                            <button type="button" class="btn btn-info">Info</button>
                                        </td>



                                    <?php } ?>


                            </tbody>
                        </table>
                    </div>
                    <!-- Edit Teacher -->
                    <script>
                        function btnclick(_url) {
                            $.ajax({
                                url: _url,
                                type: 'post',
                                success: function(data) {
                                    $('#modalbody').html(data);
                                },
                                error: function() {
                                    $('#modalbody').text('An error occurred');
                                }
                            });


                        }


                        function Save() {
                            setTimeout(function() {

                                $('#modalbody').html('');

                            }, 500);
                        }



                        function toastShow() {
                            setTimeout(function() {
                                $('#liveToast').toast('show');
                            }, 500);
                        }
                    </script>

                    <!-- <div class="modal fade" id="modalform" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit teacher</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="Save()"></button>
                                </div>
                                <div class="modal-body" id="modalbody">

                                </div>
                                <div class="modal-footer">


                                </div>
                            </div>
                        </div>
                    </div> -->
                    <?php

                    if (isset($_GET['sucsess'])) {

                        $toastteacher = getTeacher($conn, $_GET['sucsess']);
                        echo "<script type='text/javascript'>",

                        "setTimeout(function (){",
                        "$('#toasttext').html('Sucsessfully edited teacher " . $toastteacher['fname'] . " " . $toastteacher['lname'] . "');",
                        "$('#liveToast').toast('show');",
                        "}, 500);",
                        "</script>";
                    }


                    if (isset($_GET['error'])){
                        ?>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    btnclick('./inc/editTeacher.php?idteach=<?= $_GET['idteach'] ?>&error=<?= $_GET['error'] ?>');
                                    $('#modalform').modal('show');
                                });
                            </script>
                        <?php
                    }


                    ?>

                    <div class="toast-container position-fixed bottom-0 end-0 p-3">
                        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
                            <div class="toast-header">
                                <i class="fa-solid fa-database fa-spin"></i>
                                <strong class="me-auto ms-1">System</strong>
                                <small>now</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body" id="toasttext">
                                Sucsessfully edited teacher
                            </div>
                        </div>
                    </div>
                    <!-- End Edit Teaccher -->




                </div>
            <?php } else { ?>

                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                    <hr>
                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                </div>

            <?php } ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

            <script>
                $(document).ready(function() {
                    $("#navLinks li:nth-child(2) a").addClass('active')
                });
            </script>

            <div class="modal fade" id="modalform" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit teacher</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="Save()"></button>
                                </div>
                                <div class="modal-body" id="modalbody">

                                </div>
                                <div class="modal-footer">


                                </div>
                            </div>
                        </div>
            </div>
        </body>

        </html>

<?php
    } else {
        header("Location: ../login.php");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
} ?>