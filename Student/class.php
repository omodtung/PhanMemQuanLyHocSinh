<?php 
session_start();
if (isset($_SESSION['id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Student') {
     include "../DB_connection.php";
     include "data/grade.php";
     include "data/student.php";
    // echo $_SESSION['malop'];
    //  $ma_lop = $_SESSION['malop'];
    $student_id = $_SESSION['id'];
    $student = getStudentById($student_id, $conn);

     $ma_lop = $student['malop'];
     $students = getStudentsByLopCode($conn, $ma_lop);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student - Grade Summary</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style3.css">
	<link rel="icon" href="../logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <style>

    </style>
</head>
<body>
<?php 
        include "inc/navbar.php";
     ?>
<table class="tableStyle_class">
    <thead>
        <tr >
            <th>ID</th>
            <th>Tên</th>
            <th>Mã lớp</th>
            <th>Ngày Sinh</th>
            <th>Giới Tính</th>
            <th>Địa Chỉ</th>
            <th>Học Lực</th>
            <th>Hạnh Kiểm</th>
        </tr>
        <?php foreach ($students as $student) { ?>
          <tr>
                                        <td><?= $student['id'] ?></td>
                                        <td><?= $student['hotenhs'] ?></td>
                                        <td><?= $student['malop'] ?></td>
                                        <td><?= $student['ngaysinh'] ?></td>
                                        <td><?= $student['gioitinh'] ?></td>
                                        <td><?= $student['diachi'] ?></td>
                                        <td><?= $student['hanhkiem'] ?></td>
                                        <td><?= $student['hocluc'] ?></td>
                                    </tr>
                                    <?php } ?>
    </thead>
    <tbody>
        </tbody>
</table>
</body>
<script>
        $(document).ready(function() {
          $("#navLinks li:nth-child(3) a").addClass('active')
        });
      </script>
</html>
<?php 

  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 
?>