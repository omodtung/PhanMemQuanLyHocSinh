<?php
function getAllScore($conn, $id){
    $sql = "SELECT
    students.mahs,
    students.hotenhs,
    students.username,
    students.ngaysinh,
    students.gioitinh,
    students.diachi,
    students.malop,
    students.makhoi,
    score.id_subject,
    subjects.subject,
    score.diem15,
    score.diem45,
    score.thi,
    score.id_score
  FROM score
  JOIN students ON score.student_code = students.mahs
  JOIN subjects ON score.id_subject = subjects.subject_id
  WHERE score.student_code = ?";  
    $stmt = $conn->prepare($sql);
    $stmt ->execute([$id]);
 
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

 