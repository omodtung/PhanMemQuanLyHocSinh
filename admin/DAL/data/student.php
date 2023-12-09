<?php 

 
function getAllStudents($conn){
   $sql = "SELECT students.*,avgscore.HocLuc FROM students JOIN avgscore ON students.id=avgscore.student_id WHERE status = 1";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $students = $stmt->fetchAll();
     return $students;
   }else {
   	return 0;
   }
}


function getStudentUsingId( $conn , $idStudent)
{
  $sql = "SELECT students.*,avgscore.HocLuc FROM students JOIN avgscore ON students.id=avgscore.student_id WHERE id =$idStudent";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  if ($stmt->rowCount() >= 1) {
    $students = $stmt->fetch();

    return $students;
  }else {
    return 0;
  }

}



function countNumberStudentFemale($conn)
{
  $sql = "SELECT * FROM students where gioitinh='Nữ' AND status=1";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
$totalfemale = $stmt->rowCount();

return $totalfemale;

 
}
function countNumberStudentMale($conn)
{
  $sql = "SELECT * FROM students where gioitinh='Nam' AND status=1";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
$totalmale = $stmt->rowCount();

return $totalmale;

 
}
function countNumberStudent($conn)
{
  $sql = "SELECT * FROM students  where status=1 ";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
$total = $stmt->rowCount();

return $total;

 
}


function countHocLucGioi($conn)
{
  $sql = "SELECT * FROM avgscore where hocluc='Gioi' ";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
$total = $stmt->rowCount();

return $total;

 
}

function countHocLucKem($conn)
{
  $sql = "SELECT * FROM avgscore where hocluc='Kem'  ";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
$total = $stmt->rowCount();

return $total;

 
}

function findNameDocNhatHs($uname, $conn){
  $sql = "SELECT username FROM students
          WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$uname]);

  if ($stmt->rowCount() >= 1) {
    return 0;
  }else {
    return 1;
  }
}

// function countStatusExist($conn)
// {
//   $sql = "SELECT COUNT(*) FROM students Where status =1";
//   $stmt = $conn->prepare($sql);
//   $stmt->execute();

//   if ($stmt->rowCount() >= 1) {
//     $count = $stmt->fetchColumn();
//     return $count+1;
// } else {
//     return 0;
// }
// }


// function findNameDocNhat($uname, $conn){
//    $sql = "SELECT username FROM students
//            WHERE username=?";
//    $stmt = $conn->prepare($sql);
//    $stmt->execute([$uname]);



//    if ($stmt->rowCount() >= 1) {
//      return 0;
//    }else {
//    	return 1;
//    }
// }
 ?>