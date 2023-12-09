<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] = 'Admin') {
        include_once "../DB_connection.php";
        include_once "DAL/data/teacherAd.php";
        include_once "DAL/data/subject.php";
        include_once "DAL/data/grade.php";
        include_once "DAL/data/student.php";
        include_once "BL/data/teacher.php";
        include_once "BL/data/student.php";
        $teachers =   getAllTeachersBL($conn);
        $students = getAllStudentsBL($conn);
      
        //print_r($teachers);

?>
 <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Home - Su Pham Thuc Hanh High School</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="..css/style.css">
            <link rel="icon" href="..logo.png">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        </head>

        <body>
            <?php
            include_once "inc/sidebar/index.html";
            if ($students != 0) {


            ?>
                <div class="container mt-5">
                    <a href="siteAddStudent.php" class="btn btn-outline-primary btn_add_teacher">Add New Student</a>
                    <a href="./DAL/encryptpasswords.php?table=students" class="btn btn-outline-primary btn_encrypt">Encrypt All Passwords</a>
                    <div class="table table-striped">
                        <table class="thead-dark">
                            <thead>
                                <tr>

                                    <th scope="col">student ID</th>
                                    <th scope="col">USER NAME</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Full Name</th>
                                    <!-- <th scope="col">Last Name</th> -->
                                    <th scope="col">HANH KIEM</th>
                                    <th scope="col"> hOC lUC</th>
                                    <th scope="col"> NGAY SINH </th>
                                    <th scope="col"> gIOI tINH </th>
                                    <th scope="col"> Dia Chi </th>
                                    <th scope="col"> Action </th>
                                    

                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($students as  $student) { ?>

                                    <tr>
                                        <!-- <th scope="row">1</th> -->
                                        <td><?= $student['id'] ?></td>
                                        <td><?=  $student['username'] ?></td>
                                        <td><?=  $student['password'] ?></td>
                                        <td><?=  $student['hotenhs'] ?></td>
                                        <!-- <td><?=  $student['lname'] ?></td> -->
                                        <td><?=  $student['hanhkiem'] ?></td>
                                        <td><?=  $student['HocLuc'] ?></td>
                                        <td><?=  $student['ngaysinh'] ?></td>
                                        <td><?=  $student['gioitinh'] ?></td>
                                        <td><?=  $student['diachi'] ?></td>
                                        <td>
                                            <!-- <a href="teacher-edit.php?idteach=<?= $teacher['id'] ?>" class="btn btn-warning">Edit</a> -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalform" onclick="btnclick('./inc/editStudent.php?idstudent=<?= $student['id'] ?>')" data-bs-id=<?= $student['id'] ?>>
                                              Edit
                                            </button>
                                            <a href="BL/deletestudent.php?id=<?= $student['id'] ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>


                                <?php } ?>


                            </tbody>
                        </table>
                    </div>
                    <!-- Edit Student -->
                    <script>
                        function btnclick(_url){
                            $.ajax({
                                url : _url,
                                type : 'post',
                                success: function(data) {
                                $('#modalbody').html(data);
                                },
                                error: function() {
                                $('#modalbody').text('An error occurred');
                                }
                            });

                            
                        }

                        
                        function Save(){
                            setTimeout(function (){
                        
                            $('#modalbody').html('');
                                    
                            }, 500);
                        }

                        

                        function toastShow(){
                            setTimeout(function (){
                                $('#liveToast').toast('show');     
                            }, 500);
                        }
                        
                    </script>                        

                    <div class="modal fade" id="modalform" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit student</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="Save()"></button>
                                </div>
                                <div class="modal-body" id="modalbody">
                                    
                                </div>
                                <div class="modal-footer">
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div> 
                    <?php
                    
                    if(isset($_GET['sucsess'])){
                        
                        $toaststudent = getStudentUsingId($conn,$_GET['sucsess']);
                        echo "<script type='text/javascript'>",
                            
                            "setTimeout(function (){",
                                "$('#toasttext').html('Sucsessfully edited student ". $toaststudent['username'] . " " . $toaststudent['hotenhs'] ."');",
                                "$('#liveToast').toast('show');",     
                            "}, 500);",
                            "</script>"
                        ;
                        
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
                                Sucsessfully edited student
                            </div>
                        </div>
                    </div>
                    <!-- End Edit Student -->
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
                    $("#navLinks li:nth-child(3) a").addClass('active')
                });
            </script>
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