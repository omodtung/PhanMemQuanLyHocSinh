<?php 
session_start();
if (isset($_SESSION['id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Student') {
       include "../DB_connection.php";
       include "../Student/data/student.php";
      //  include "data/subject.php";
       include "../Student/data/grade.php";
      //  include "data/section.php";
       $student_id = $_SESSION['id'];
       
       $student = getStudentById($student_id, $conn);
       $img = getImgById($conn,$student_id);
      


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student - Home</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">

  <link rel="stylesheet" href="../css/style3.css">
	<link rel="icon" href="../logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



</head>
<body>

  <section class="home-section">
    <?php 
        include "inc/navbar.php";
     ?>
     <?php 
        if ($student != 0) {
          
          $defaultImagePath = "../img/student-{$student['gioitinh']}.jpg";

          if ($student['id'] && isset($img['id'])) {
            $imagePath ='systemManageStudentNew/' .$img['image_path'];
        } else {
            // Nếu không có ảnh, sử dụng ảnh mặc định
            $imagePath = $defaultImagePath;
        }
     ?>
     
     <div style="display: flex;" class="container mt-5">
         <div class="card" style="width: 22rem;">
         <!-- Hình ảnh với sự kiện onclick -->
<img src="<?= $imagePath ?>" class="card-img-top" alt="Student Image" style="height: 220px; cursor: pointer;">


         
          <div class="card-body">
          
            <h5 class="card-title text-center">@<?=$student['username']?></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Mã Học Sinh: <?=$student['mahs']?></li>
            <li class="list-group-item">Username: <?=$student['username']?></li>
            <li class="list-group-item">Họ và tên: <?=$student['hotenhs']?></li>
            <li class="list-group-item">Ngày sinh: <?=$student['ngaysinh']?></li>
            <li class="list-group-item">Giới tính: <?=$student['gioitinh']?></li>
            <li class="list-group-item">Địa Chỉ: <?=$student['diachi']?></li>

            <li class="list-group-item">Khối: 
                 <?php 
                      $grade = $student['makhoi'];
                      $g = getGradeBycode($grade, $conn);
                      echo $g['grade'];
                  ?>
            </li> 
          </ul>
        </div>
        
                    
                    
                  
        <div>
          <h2 style="text-align: center;">BẢNG ĐIỂM TRUNG BÌNH</h2>
        <table class="tableStyle">
          <tr style="width:100%" style="text-align: center">
            <th>Toán</th>
            <th>Vật Lý</th>
            <th>Hóa Học</th>
            <th>Ngữ Văn</th>
            <th>Lịch Sử</th>
            <th>Địa Lí</th>
            <th>Tiếng Anh</th>
            <th>GDCD</th>
            <th>Công Nghệ</th>
            <th>Tin Học</th>
            <th>Thể Dục</th>       
            <th>Sinh Học</th>
          </tr>
          <tr>
            <td><?=$student['Toan']?></td>
            <td><?=$student['Vatly']?></td>
            <td><?=$student['Hoahoc']?></td>
            <td><?=$student['Nguvan']?></td>
            <td><?=$student['Lichsu']?></td>
            <td><?=$student['Dialy']?></td>
            <td><?=$student['TiengAnh']?></td>
            <td><?=$student['GDCD']?></td>
            <td><?=$student['Congnghe']?></td>
            <td><?=$student['Tinhoc']?></td>
            <td><?=$student['Theduc']?></td>
            <td><?=$student['Sinhhoc']?></td>
          </tr>
        </table>


       
        <table class="tableStyle">
          <tr style="width:100%">
            <th>Toán</th>
            <th>Vật Lý</th>
            <th>Hóa Học</th>
            <th>Ngữ Văn</th>
            <th>Lịch Sử</th>
            <th>Địa Lí</th>
            <th>Tin Học</th>
            <th>Tiếng Anh</th>
            <th>GDCD</th>
            <th>Công Nghệ</th>
            <th>Thể Dục</th>       
            <th>Sinh Học</th>
          </tr>
          <tr>
            <td><?=$student['Toan2']?></td>
            <td><?=$student['VatLy2']?></td>
            <td><?=$student['Hoa2']?></td>
            <td><?=$student['NguVan2']?></td>
            <td><?=$student['LichSu2']?></td>
            <td><?=$student['DiaLi2']?></td>
            <td><?=$student['TiengAnh2']?></td>
            <td><?=$student['GDCD2']?></td>
            <td><?=$student['CongNghe2']?></td>
            <td><?=$student['TinHoc2']?></td>
            <td><?=$student['TheDuc2']?></td>
            <td><?=$student['SinhHoc2']?></td>
          </tr>
        </table>
          
        </div>
         <script>
        $(document).ready(function() {
          $("#navLinks li:nth-child(1) a").addClass('active')
        });

    
</script>
      </scrip>  
     </div>
     <a class="btn_pdf" href="info1.php">Export to PDF</a>
     <?php 
        }else {
          header("Location:../login.php ");
          exit;
        }
     ?>
     
    
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

