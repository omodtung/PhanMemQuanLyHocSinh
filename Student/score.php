<?php 
session_start();
if (isset($_SESSION['id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Student') {
     include "../DB_connection.php";
     include "data/grade.php";
     include "data/student.php";
     include "inc/navbar.php";
    // echo $_SESSION['malop'];
    //  $ma_lop = $_SESSION['malop'];
    $student_id = $_SESSION['id'];
    $student = getStudentById($student_id, $conn);

     $mahocsinh = $student['mahs'];
     $scores = getAllScore($conn, $mahocsinh);
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
<table class="tableStyle_score">
<thead>
                                <tr>
                                <th scope="col">Môn Học</th>
                            
                                    <th scope="col">Điểm 15 phút</th>
                                    <th scope="col">Điểm 45 phút</th>
                                    <th scope="col">Điểm Thi</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($scores as  $score) { ?>
                                            
                                        
                                    <tr>
                                        <td><?= $score['subject'] ?></td>
                    
                                        <td><?= $score['diem15'] ?></td>
                                        <td><?= $score['diem45'] ?></td>
                                        <td><?= $score['thi'] ?></td>
                        
        
                                    </tr>


                                <?php } ?>


                            </tbody>
                        </table>
</body>
<script>
        $(document).ready(function() {
          $("#navLinks li:nth-child(2) a").addClass('active')
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