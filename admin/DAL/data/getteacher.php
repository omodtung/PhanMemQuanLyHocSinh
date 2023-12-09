
<?php  

// tim kiem giao vien theo id
function getTeacher($conn,$idteacher){
   $sql = "SELECT * FROM teachers WHERE id = $idteacher";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() == 1) {
     $teacher = $stmt->fetch();
     return $teacher;
   }else {
   	return 0;
   }
}

// kiem tra neu nhu ten nay doc nhat 
function findNameDocNhat2($uname, $conn){
   $sql = "SELECT username FROM teachers
           WHERE username=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$uname]);

   if ($stmt->rowCount() >= 1) {
     return 0;
   }else {
   	return 1;
   }
}