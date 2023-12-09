<?php
function getAllScore($conn, $id){
    $sql = "SELECT id_subject,subject,diem15,diem45,thi FROM score,students,subjects WHERE score.student_code = ? and students.mahs = ? and id_subject = subject_id";
    $stmt = $conn->prepare($sql);
    $stmt ->execute([$id,$id]);
 
    if ($stmt->rowCount() >= 1) {
     
      $score = $stmt->fetchAll();
 
      return $score;
    }else {
        return 0;
    }
 }
 function getScore($conn,$id_score){
  $sql = "SELECT * FROM score WHERE id_score = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id_score]);

  if ($stmt->rowCount() == 1) {
    $score = $stmt->fetch();
    return $score;
  }else {
    return 0;
  }
}

function getGradeBycode($grade_code, $conn){
  $sql = "SELECT * FROM grades
          WHERE grade_code=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$grade_code]);

  if ($stmt->rowCount() == 1) {
    $grade = $stmt->fetch();
    return $grade;
  }else {
   return 0;
  }
}


 



