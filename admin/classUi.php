<?php

session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] = 'Admin') {
        include_once "../DB_connection.php";
       
        include_once "DAL/data/class.php";
        include_once "BL/data/class.php";

        $classes = getAllClassBL($conn);
$teacher
        //print_r($teachers);
?>

        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Home - Su Pham Thuc Hanh High School</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="..css/style.css">
                <link rel="stylesheet" href="../css/style2.css">
                   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
                 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
            <link rel="icon" href="..logo.png">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
            <title>Document</title>
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
                        <a href="addClassSite.php">
                            <i class="bx bx-grid-alt"></i>
                            <span class="link_name"> ADD Class </span>
                        </a>
                        <span class="tooltip">ADD</span>
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
            if ($classes != 0) {


            ?>



                <div class="container mt-5">
                    
                   
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead   class="thead-dark" style="background-color:black; color:azure;">
                                <tr>

                                    <th scope="col">CLass ID</th>
                                    <th scope="col">Name Class</th>

                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($classes as  $class) { ?>

                                    <tr>
                                        <!-- <th scope="row">1</th> -->

                                        <td><?= $class['manamhoc'] ?></td>
                                        <td><?= $class['classname'] ?></td>

                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalform" onclick="btnclick('./inc/editClass.php?id=<?= $class['classname'] ?>')" data-bs-id=<?= $class['classname'] ?>>Edit</button>
                                            <a href="BL/deleteclass.php?id=<?= $class['classname'] ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>


                                <?php } ?>


                            </tbody>
                        </table>
                    </div>


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


<div class="toast-container position-fixed bottom-0 end-0 p-3">
                            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
                                <div class="toast-header">
                                    <i class="fa-solid fa-database fa-spin"></i>
                                    <strong class="me-auto ms-1">System</strong>
                                    <small>now</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body" id="toasttext">
                                    Sucsessfully edited student
                                </div>
                            </div>
                        </div>
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
                    $("#navLinks li:nth-child(4) a").addClass('active')
                });
            </script>
        </section>
            <div class="modal fade" id="modalform" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Class</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="Save()"></button>
                    </div>
                    <div class="modal-body" id="modalbody">

                    </div>
                    <div class="modal-footer">


                    </div>
                </div>
            </div>
        </div>
                    <script src="../js/script.js"></script>
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