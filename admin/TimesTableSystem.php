<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] = 'Admin') {
        include_once "../DB_connection.php";
        include_once "DAL/data/student.php";
        include_once "DAL/data/subject.php";
        include_once "DAL/data/grade.php";
        include_once "DAL/data/timetable.php";
        include_once "DAL/data/schedule.php";
        //$teachers =   getAllTeachers($conn);
        include_once "BL/data/timetable.php";

        $timetable = getAllTimeTableBL($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <link rel="stylesheet" href="../css/style.css">


    <link rel="stylesheet" href="../css/style2.css">
    <link rel="icon" href="..logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
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
                <a target="_blank" rel="noopener noreferrer" href="./DAL/export.php?schedule=1">
                    <i class="bx bx-export"></i>
                    <span class="link_name">Export All Schedules</span>
                </a>
                <span class="tooltip">Delete</span>
            </li>
            <!-- <li>
                <a href="#">
                    <i class="bx bx-cart-alt"></i>
                    <span class="link_name">View info</span>
                </a>
                <span class="tooltip">View</span>
            </li> -->
            <li>
                <a href="#">
                    <i class="bx bx-cog"></i>
                    <span class="link_name">Setting</span>
                </a>
                <span class="tooltip">Settings</span>
            </li>
            <li class="profile">
                <div class="profile_details">
                    <img src="../img/profile.jpeg" alt="profile image">
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
        ?>
        <div class="container mt-5">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark" style="background-color:black; color:azure;">
                        <tr>
                            <th scope="col">Ma</th>
                            <th scope="col">Ho Ten</th>
                            <th scope="col">Lop</th>
                            <th scope="col"> Action </th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach ($timetable as  $table) { ?>

                            <tr>
                                <td><?= $table['mahs'] ?></td>
                                <td><?= $table['hotenhs'] ?></td>
                                <td><?= $table['malop'] ?></td>

                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalforminfo" onclick="btnclickinfo('./inc/TimeTableinfo.php?id=<?= $table['malop'] ?>')" data-bs-id=<?= $table['malop'] ?>>
                                        Detail
                                    </button>
                                </td>
                                <div id="searchresult"></div>
                            </tr>


                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modalforminfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="Save()"></button>
                </div>
                <div class="modal-body" id="modalbodyinfo">

                </div>
                <div class="modal-footer">

                    <div class="position-relative pt-5">

                        <button type="button" class="btn btn-primary position-absolute bottom-0 end-0" data-bs-dismiss="modal" id="Sucsessbtn" onclick="Save()">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

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

        function btnclickadd(_url) {
            $.ajax({
                url: _url,
                type: 'post',
                success: function(data) {
                    $('#modalbodyadd').html(data);
                },
                error: function() {
                    $('#modalbodyadd').text('An error occurred');
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

        $(document).ready(function() {
            $("#navLinks li:nth-child(5) a").addClass('active')
        });
    </script>

    <?php

    if (isset($_SESSION['sucsess'])) {

        $toastschedule = getSchedule($conn, $_SESSION['sucsess']);
        echo "<script type='text/javascript'>",

        "setTimeout(function (){",
        "$('#toasttext').html('Sucsessfully edited schedule of " . $toastschedule['HoTen'] . "');",
        "$('#liveToast').toast('show');",
        "}, 500);",
        "</script>";
        unset($_SESSION['sucsess']);
    }

    if (isset($_GET['error'])) {
    ?>
        <script type="text/javascript">
            $(document).ready(function() {
                btnclick('./inc/editSchedule.php?id=<?= $_GET['id'] ?>&error=<?= $_GET['error'] ?>');
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
                Sucsessfully edited schedule
            </div>
        </div>
    </div>
    <script src="../js/script.js"></script>
    <!-- import ajax live searching -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#live_search").keyup(function() {
                var input = $(this).val();
                if (input != "") {
                    $.ajax({
                        url: "livesearch.php?timetable=1",
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
</body>

</html>