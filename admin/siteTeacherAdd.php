<?php


session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
  if ($_SESSION['role'] == 'Admin') {
    include_once "../DB_connection.php";
    include_once "DAL/data/subject.php";
    include_once "DAL/data/grade.php";
    include_once "DAL/data/teacherAd.php";
    include_once "BL/data/subject.php";
    include_once "BL/data/teacher.php";
    include_once "BL/data/grade.php";

    $subjects = getAllSubjectsBL($conn);
    $teacher = getAllTeachersBL($conn);

    $grades = getAllGradeBL($conn);
    $fname = '';
    $lname  = '';
    $uname  = '';
    $birthdate = '';
$diaChi = '';

$flname = '';
$maGiaoVien ='';

    // $pass = '';
    // $flname = '';
    // $lopChuNhiem = '';

    $gioiTinh = '';
    

    if (isset($_GET['uname'])) $uname = $_GET['uname'];


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

    <body >
    <?php 
        include_once "inc/navBar.php";
     ?>

      <div class="container mt-5">
        <a href="teacherNewUI.php" class="btn btn-outline-primary btn_add_teacher">Back</a>

        <form  method="post" class="shadow p-3 mt-5 form-w" action="BL/addTeacher.php">
          <h3> Form Thêm Giáo Viên</h3>
          <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
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
              <!-- <div class="col">
                <label class="form-lable">

                  First Name
                </label>
                <input type="text" class="form-control" placeholder="example Tung" value="<?= $fname ?>" name="fname">
              </div> -->
              <div class="col">
                <label class="form-lable">

                Đia Chỉ
                </label>
                <input type="text" class="form-control" placeholder="12A Đường Trường Chinh Quận Tân Bình" name="diaChi" value="<?= $diaChi ?>">
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label class="form-lable">

                Ho Tên
                </label>
                <input type="text" class="form-control" placeholder=" example :Đỗ Thế Tùng" name="flname" value="<?= $flname ?>">
              </div>
              <div class="col">
                <label class="form-lable">

                User Name
                </label>
                <input type="text" class="form-control" placeholder="tungdo" name="uname" value="<?= $uname ?>">

              </div>
            </div>

            <label class="form-lable">

              PassWord
            </label>
            <input type="text" class="form-control" name="pass">

            <!-- chon BirthDate -->
            <div class="row">
            
              <h3 class="pt-4 pb-2" style="display: 14px;"> Birth Date</h3>
             <div   class="col-md-6 mt-md-0 mt-3">
                <div class="row form-group">
                  <label for="date" class="col-sm-1 col-form-label">Date</label>
                  <div class="col-sm-4">
                    <div class="input-group date" id="datepicker">
                    <input type="text" class="form-control" name="birthdate" >
                      <span class="input-group-append">
                        <span class="input-group-text bg-white">
                          <i class="fa fa-calendar"></i>
                        </span>
                      </span>
                    </div>
                  </div>
                </div>

             </div>
                
        
           
            <script type="text/javascript">
              $(function() {
                $('#datepicker').datepicker({dateFormat : 'yy-mm-dd'});
              });
            </script>
            <!-- chon Gioi Tinh -->

            <div class="col-md-6 mt-md-0 mt-3">
            <div class="col">
              <label class="form-lable">

                Giới Tính
              </label>


              <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="genderbtn" value="Nam" id="btnradio1">
                            <label class="btn btn-outline-primary rounded ms-5" for="btnradio1">Nam</label>

                            <input type="radio" class="btn-check" name="genderbtn" value="Nữ" id="btnradio2">
                            <label class="btn btn-outline-primary rounded ms-2" for="btnradio2">Nu</label>

                        </div>


            </div>
            </div>
         
          </div>

            <h3> Mã Giáo Viên </h3>
           
            <input type="text" class="form-control" placeholder="example:tungdo" name="idGV" value="<?= $maGiaoVien ?>">
           

          
           



 

<div class="row">



            <div class="col-md-6 mt-md-0 mt-3">
              <label class="form-label">Môn Học</label>
              <div class="row row-cols-5">
              <select name="subjects[]" class="form-select" aria-label="Default select example" multiple>
                                    <?php foreach ($subjects as $subject) : ?>


                                        <option value="<?= $subject['subject_id'] ?>"> <?= $subject['subject'] ?></option>
                                    <?php endforeach ?>
                                </select>

              </div>
            </div>
            <div class="col-md-6 mt-md-0 mt-3">
              <label class="form-label">Khối</label>
              <div class="row row-cols-5">
              <select name="grades[]" class="form-select" aria-label="Default select example" multiple >
                                    <?php foreach ($grades as $grad) : ?>


                                        <option value="<?= $grad['grade_id'] ?>"> <?= $grad['grade'] ?></option>
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