<?php


session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
  if ($_SESSION['role'] == 'Admin') {
    include_once "../../DB_connection.php";
    include_once "../DAL/data/subject.php";
    include_once "../DAL/data/grade.php";
    include_once "../DAL/data/getteacher.php";
    include_once "../DAL/data/student.php";
    include_once "../DAL/data/class.php";
    include_once "../BL/data/class.php";
    include_once "../BL/data/subject.php";
    include_once "../BL/data/grade.php";
    include_once "../BL/data/student.php";
    $subjects = getAllSubjectsBL($conn);
    $grades = getAllGradeBL($conn);
    $student = getStudentUsingIdBL($conn,$_GET['idstudent']);
    $class = getAllClassBL($conn);
    $id = $_GET['idstudent'];
    $fname = '';
    $lname  = '';
    $uname  = '';
    $pass = '';
    $flname = '';
    $lopChuNhiem = '';
    $teacher_subjects = '';
    if (isset($_GET['fname'])) $fname =  $_GET['fname'];

    if (isset($_GET['lname'])) $lname  = $_GET['lname'];

    if (isset($_GET['username'])) $uname = $_GET['username'];
    //print_r( $student);
    //if (isset($_GET['subjects'])) $teacher_subjects = $_GET['uname'];

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
      //include_once "inc/navBar.php";
      ?>

      <div class="container mt-5 pb-3">
        <form method="post" class="shadow p-3 mt-2 form-w" action="DAL/student-edit.php?id=<?= $id ?>">
          
          <div class="mb-3">

            <div class="form-row">
                <div class="col">
                <label class="form-lable">

                  User Name
                </label>
                <input type="text" disabled class="form-control" placeholder="example:tungdo" name="uname" value="<?= $student['username'] ?>">

              </div>
              <div class="col">
                <label class="form-lable">

                  Full Name
                </label>
                <input type="text" disabled class="form-control" placeholder="example Do The Tung" value="<?= $student['hotenhs'] ?>" name="hotenhs">
              </div>
              <div class="col">
                <label class="form-lable">

                  Address
                </label>
                <input type="text" disabled class="form-control" placeholder="example 22nd Roads" value="<?= $student['diachi'] ?>" name="diachi">
              </div>
              <!-- <div class="col">
                <label class="form-lable">

                  Last Name
                </label>
                <input type="text" class="form-control" placeholder="example Do" name="lname" value="<?= $student['lname'] ?>">
              </div> -->
            </div>
            <div class="form-row pt-4">
              <div class="col">
                <label class="form-lable">

                  Hanh Kiem
                </label>
                <select class="form-select" disabled name="hanhkiem" aria-label="Default select example">
                  <option value="Tốt" <?php echo ($student['hanhkiem'] == "Tốt") ? 'selected' : ''; ?>>Tốt</option>
                  <option value="Khá" <?php echo ($student['hanhkiem'] == "Khá") ? 'selected' : ''; ?>>Khá</option>
                  <option value="Trung Bình" <?php echo ($student['hanhkiem'] == "Trung Bình") ? 'selected' : ''; ?>>Trung Bình</option>
                  <option value="Yếu" <?php echo ($student['hanhkiem'] == "Yếu") ? 'selected' : ''; ?>>Yếu</option>
                </select>
                <!-- <input type="text" class="form-control" disable placeholder=" example :Tốt" name="hanhkiem" value="<?= $student['hanhkiem'] ?>"> -->
              </div>
              <div class="col">
                <label class="form-lable">

                  Hoc Luc
                </label>
                <select class="form-select" disabled aria-label="Default select example">
                  <option value="1" <?php echo ($student['HocLuc'] == "Gioi") ? 'selected' : ''; ?>>Giỏi</option>
                  <option value="2" <?php echo ($student['HocLuc'] == "Kha") ? 'selected' : ''; ?>>Khá</option>
                  <option value="3" <?php echo ($student['HocLuc'] == "Trung Binh") ? 'selected' : ''; ?>>Trung Bình</option>
                  <option value="4" <?php echo ($student['HocLuc'] == "Yeu") ? 'selected' : ''; ?>>Yếu</option>
                  <option value="5" <?php echo ($student['HocLuc'] == "Kem") ? 'selected' : ''; ?>>Kém</option>
                </select>
                <!-- <input type="text" class="form-control" placeholder=" example :Giỏi" name="hocluc" value="<?= $student['HocLuc'] ?>"> -->
              </div>
              

            </div>

            <label class="form-lable pt-4">

              PassWord
            </label>
            <input type="text" id="passtext" class="form-control" placeholder="PassWord" value="<?= $student['password'] ?>" name="pass" disabled>
            <div class="pt-2 ms-2">
                
                
            </div>
            <!-- chon BirthDate -->
            <section class="container">
              <h3 class="pt-4 pb-2">BirthDate</h3>
              <form>
                <div class="row form-group">
                  <label for="date" class="col-sm-1 col-form-label">Date</label>
                  <div class="col-sm-4">
                    <div class="input-group date" id="datepicker">
                      <input type="text" disabled class="form-control" name="birthdate" value="<?php echo date("d/m/Y", strtotime($student['ngaysinh'])); ?>">
                      <span class="input-group-append">
                        <span class="input-group-text bg-white">
                          <i class="fa fa-calendar"></i>
                        </span>
                      </span>
                    </div>
                  </div>
                </div>


                </script>
            </section>
            <!-- <script type="text/javascript">
              $(function() {
                $('#datepicker').datepicker({dateFormat : 'yy-mm-dd'});
              });
            </script> -->
            <!-- chon Gioi Tinh -->
            <div class="col">
              <label class="form-lable">

                Gioi Tinh
              </label>

              <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" disabled name="genderbtn" value="Nam" id="btnradio1" autocomplete="off" <?php echo ($student['gioitinh'] == "Nam") ? 'checked' : ''; ?>>
                <label class="btn btn-outline-primary rounded ms-5" for="btnradio1">Nam</label>

                <input type="radio" class="btn-check" disabled name="genderbtn" value="Nữ" id="btnradio2" autocomplete="off" <?php echo ($student['gioitinh'] == "Nữ") ? 'checked' : ''; ?>>
                <label class="btn btn-outline-primary rounded ms-2" for="btnradio2">Nu</label>

            </div>

            </div>
            <!-- <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" <?php echo ($teacher['gioitinh'] == "M") ? 'checked' : ''; ?>>
              <label class="form-check-label" for="inlineCheckbox1">Nam</label>
              
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
              <label class="form-check-label" for="inlineCheckbox2">Nu</label>
            </div> -->

            


            
            <h3> Thuoc</h3>
            <div class="container">
                <div class="row">
                    

                    <div class="col-sm-1">
                    <label class="form-label">Grade</label>
                    
                    </div>
                    <div class="col-sm-3">
                        <!-- <select name="grades[]" multiple>
                        <?php foreach ($grades as $grade) : ?>
                        <option value="<?= $grade['grade_id'] ?>" <?php echo (in_array($grade['grade_id'],explode(",", $student['grade_id']))) ? 'selected' : ''; ?>><?= $grade['grade_code'] ?>-<?= $grade['grade'] ?></option>
                        <?php endforeach ?> -->
                        <select name="grade" disabled>
                        <?php foreach ($grades as $grade) : ?>
                        <option value="<?= $grade['grade_code'] ?>" <?php echo (in_array($grade['grade_id'],explode(",", $student['makhoi']))) ? 'selected' : ''; ?>><?= $grade['grade_code'] ?>-<?= $grade['grade'] ?></option>
                        <?php endforeach ?>
                    </select>
                    </div>

                    <div class="col-sm-1">
                    <label class="form-label">Grade</label>
                    
                    </div>
                    <div class="col-sm-1">
                        <select name="class" disabled>
                        <?php foreach ($class as $cls) : ?>
                        <option value="<?= $cls['classname'] ?>" <?php echo ($cls['classname'] == $student['malop']) ? 'selected' : ''; ?>><?= $cls['classname'] ?></option>
                        <?php endforeach ?>
                    </select>
                    </div>
                </div>
            </div>
            






            <div class="position-relative pt-4">
                
                <button type="button" class="btn btn-primary position-absolute bottom-0 end-0" data-bs-dismiss="modal" id="Sucsessbtn" onclick="Save()">Close</button>
            </div>
            
        </form>
        
      </div>





    </body>

    </html>

  <?php } else { ?>

  <?php  } ?>

<?php } else { ?>

<?php } ?>