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


function getAllStudentNotavg($conn){
  $sql = "SELECT * FROM students Where status =1";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  if ($stmt->rowCount() >= 1) {
   
    $students= $stmt->fetchAll();

    return $students;
  }else {
      return 0;
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