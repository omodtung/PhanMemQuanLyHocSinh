<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] = 'Admin') {
        include_once "../DB_connection.php";
        include_once "DAL/data/teacherAd.php";
        include_once "DAL/data/subject.php";
        include_once "DAL/data/grade.php";
        include_once "DAL/data/getteacher.php";
        include_once "BL/data/teacher.php";

        $teachers =   getAllTeachersBL($conn);



        //print_r($teachers);

?>


        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Home - Su Pham Thuc Hanh High School</title>
            <link rel="stylesheet" href="../css/style.css">

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="../css/style2.css">

            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

            <link rel="icon" href="..logo.png">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- import jquery for live Search -->




            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
            <script>
                function showResult(str) {
                    if (str.length == 0) {
                        document.getElementById("livesearch").innerHTML = "";
                        document.getElementById("livesearch").style.border = "0px";
                        return;
                    }
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("livesearch").innerHTML = this.responseText;
                            document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
                        }
                    }
                    xmlhttp.open("GET", "livesearch.php?q=" + str, true);
                    xmlhttp.send();
                }
            </script>
        </head>

        <body>
            <div class="sidebar">
                <div class="logo_details">
                    <i class="bx bxl-audible icon"></i>
                    <div class="logo_name">Admin </div>
                    <i class="bx bx-menu" id="btn"></i>
                </div>
                <ul class="nav-list">
                    <li>
                        <i class="bx bx-search"></i>
                        <input type="text" id="live_search" placeholder="Search...">
                        <span class="tooltip">Search</span>
                    </li>
                    <li>
                        <a href="siteTeacherAdd.php">
                            <i class="bx bx-grid-alt"></i>
                            <span class="link_name"> ADD Teacher </span>
                        </a>
                        <span class="tooltip">ADD</span>
                    </li>

                    <li>
                        <a href="./DAL/encryptpasswords.php?table=teachers">
                            <i class="bx bx-chat"></i>
                            <span class="link_name">Encrypt All Passwords</span>
                        </a>
                        <spsuccessan class="tooltip">Encrypt</span>
                    </li>

                    <li>
                        <a data-toggle="modal" data-target=".bd-example-modal-lg">
                            <i class="bx bx-folder"></i>
                            <span class="link_name">Filter Teacher</span>
                        </a>
                        <span class="tooltip">
                            Filter


                        </span>


                    </li>

                    <li>
                        <a target="_blank" rel="noopener noreferrer" href="./BL/export.php?teacher=1">
                            <i class="bx bx-export"></i>
                            <span class="link_name">Export All Teachers</span>
                        </a>
                        <span class="tooltip">Export</span>
                    </li>
                    <li>
                        <a href="Overview.php">
                            <i class="bx bx-cart-alt"></i>
                            <span class="link_name">Thống Kê</span>
                        </a>
                        <span class="tooltip">Thống Kê</span>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bx bx-cog"></i>
                            <span class="link_name">Setting</span>
                        </a>
                        <span class="tooltip">Settings</span>
                    </li>
                    <li class="profile">
                        <div class="profile_details">
                            <!-- <img src="../img/profile.jpeg" alt="profile image"> -->
                            <div class="profile_content">
                                <div class="name"><?= $_SESSION['admin_name'][0] ?> <?= $_SESSION['admin_name'][1] ?></div>
                                <div class="designation">Admin</div>
                            </div>
                        </div>
                        <i class="bx bx-log-out" id="log_out"></i>
                    </li>
                </ul>
            </div>
            <section class="home-section">


                <?php
                include_once "inc/navBar.php";
                if ($teachers != 0) {


                ?>
                    <div class="container mt-5">
                        <!-- <div class="sticky-top">
                            <a href="siteTeacherAdd.php" class="btn btn-outline-primary btn_add_teacher">Add New Teacher</a>
                            <a href="./DAL/encryptpasswords.php?table=teachers" class="btn btn-outline-primary btn_encrypt">Encrypt All Passwords</a>
                        </div> -->

                        <style>
                            th {
                                text-align: center;

                            }


                            td {
                                text-align: center;


                            }
                        </style>
                        <div class="table-responsive">
                            <!-- <table class="table table-success table-striped n-table"> -->
                            <table class="table table-striped">
                                <thead class="thead-dark" style="background-color:black; color:azure;">
                                    <tr>

                                        <th scope="col">Teacher ID</th>
                                        <th scope="col">UserName</th>
                                        <!-- <th scope="col" style="width:20%">PASSWORD</th> -->
                                        <th scope="col">Họ Tên</th>
                                        <th scope="col">Mã Môn Học</th>
                                        <!-- <th scope="col">Ma  khoi</th> -->
                                        <th scope="col"> ngày sinh</th>

                                        <th scope="col"> Giới Tính </th>
                                        <th scope="col"> Địa Chỉ </th>
                                        <th scope="col"> Mã Giáo Viên </th>
                                        <th scope="col">Mã khối</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>


                                    <?php foreach ($teachers as  $teacher) { ?>

                                        <tr>
                                            <!-- <th scope="row">1</th> -->
                                            <td><?= $teacher['id'] ?></td>
                                            <td><?= $teacher['username'] ?></td>
                                            <!-- <td><?= substr($teacher['password'], 5) ?>...</td> -->
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

                                            <td style="display:inline-flex">
                                                <!-- <a href="teacher-edit.php?idteach=<?= $teacher['id'] ?>" class="btn btn-warning">Edit</a> -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalform" onclick="btnclick('./inc/editTeacher.php?idteach=<?= $teacher['id'] ?>')" data-bs-id=<?= $teacher['id'] ?>>
                                                    Edit
                                                </button>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalinfo" onclick="btnclickinfo('./inc/TeacherInfo.php?idteach=<?= $teacher['id'] ?>')" data-bs-id=<?= $teacher['id'] ?> class="btn btn-info">Info</button>
                                                <a href="./BL/deleteteacher.php?id=<?= $teacher['id'] ?>" class="btn btn-danger">Delete</a>



                                               
                                            </td>
                                            <div id="searchresult"></div>

                                        </tr>

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

                            function btnclickinfo(_url) {
                                $.ajax({
                                    url: _url,
                                    type: 'post',
                                    success: function(data) {
                                        $('#modalbodyinfo').html(data);
                                    },
                                    error: function() {
                                        $('#modalbodyinfo').text('An error occurred');
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

                        if (isset($_SESSION['success'])) {

                            $toastteacher = getTeacher($conn, $_SESSION["success"]);
                            echo "<script type='text/javascript'>",

                            "setTimeout(function (){",
                            "$('#toasttext').html('Sucsessfully edited teacher " . $toastteacher['hoten'] . " " . $toastteacher['username'] . "');",
                            "$('#liveToast').toast('show');",
                            "}, 500);",
                            "</script>";
                            //$_SESSION["success"] = "";
                            unset($_SESSION['success']);
                        } else {
                        }


                        if (isset($_GET['error'])) {
                        ?>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    btnclick('./inc/editTeacher.php?idteach=<?= $_GET['idteach'] ?>&error=<?= $_GET['error'] ?>');
                                    $('#modalform').modal('show');
                                });
                            </script>
                        <?php
                        }

                        if (isset($_SESSION['openfilter'])) {
                        ?>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('#modalfilter').modal('show');
                                });
                            </script>
                        <?php

                            unset($_SESSION['openfilter']);
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

            </section>
            <!-- Scripts -->
            <script src="../js/script.js"></script>

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

            <div class="modal fade" id="modalinfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Teacher Info</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="Save()"></button>
                        </div>
                        <div class="modal-body" id="modalbodyinfo">

                        </div>
                        <div class="modal-footer">


                        </div>
                    </div>
                </div>
                <td><?= $teacher['hoten'] ?></td>

            </div>



            <!-- import ajax live searching -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {

                    $("#live_search").keyup(function() {
                        var input = $(this).val();

                        if (input != "") {

                            $.ajax({
                                url: "BL/livesearchBL.php",
                                method: "POST",
                                data: {
                                    input: input
                                },
                                success: function(data) {
                                    $("#searchresult").html(data);
                                    $("#searchresult").css("display", "block");
                                }

                            });

                        } else {
                            $("#searchresult").css("display", "none");
                        }

                    })

                })
            </script>


            <div class="modal fade bd-example-modal-lg" id="modalfilter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <?php include_once("BL/indexFilterTeacherBL.php"); ?>
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