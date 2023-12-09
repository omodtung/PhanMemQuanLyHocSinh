<?php 

// All Students 
function getAllStudents($conn){
   $sql = "SELECT * FROM students";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $students = $stmt->fetchAll();
     return $students;
   }else {
   	return 0;
   }
}

function getStudentsByLopCode($conn, $ma_lop) {
  $sql = "SELECT * FROM students WHERE malop = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $ma_lop);
  $stmt->execute();

  if ($stmt->rowCount() >= 1) {
      $students = $stmt->fetchAll();
      return $students;
  } else {
      return 0;
  }
}




function getStudentById($id, $conn){
   $sql = "SELECT *
   FROM students 
   JOIN avgscore  ON students.id = avgscore.student_id
   JOIN avgscore2  ON students.id = avgscore2.ID_student
   WHERE students.id = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() == 1) {
     $student = $stmt->fetch();
     return $student;
   }else {
    return 0;
   }
}

function getImgById($conn, $id){
  $sql = "SELECT *
  FROM images 
  WHERE images.id_student = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);

  if ($stmt->rowCount() == 1) {
    $student = $stmt->fetch();
    return $student;
  }else {
   return 0;
  }
}


function studentPasswordVerify($student_pass, $conn, $student_id){
  $sql = "SELECT * FROM students
          WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$student_id]);

  if ($stmt->rowCount() == 1) {
    $student = $stmt->fetch();
    $pass  = $student['password'];

    if (password_verify($student_pass, $pass)) {
       return 1;
    }else {
       return 0;
    }
  }else {
   return 0;
  }
}



function getScheduleMaLop($conn,$ma_lop){
  $sql = "SELECT * FROM schedule WHERE Class = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$ma_lop]);

  if ($stmt->rowCount() >= 1) {
    $schedules = $stmt->fetchAll();
    return $schedules;
  }else {
    return 0;
  }
}


// function getDiem($conn, $id_student) {
//   $sql = "SELECT * FROM avgscore WHERE ID_student = ?";
//   $stmt = $conn->prepare($sql);
//   $stmt->bindParam(1, $id_student);
//   $stmt->execute();

//   if ($stmt->rowCount() == 1) {
//       $avgscore = $stmt->fetchAll();
//       return $avgscore;
//   } else {
//       return 0;
//   }
// }