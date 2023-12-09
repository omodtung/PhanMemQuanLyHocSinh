
<?php  

// tim kiem tat ca giao vien


function getAllTeachers($conn){
  $sql = "SELECT * FROM teachers WHERE status = 1";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  if ($stmt->rowCount() >= 1) {
    $teachers = $stmt->fetchAll();
    return $teachers;
  }else {
    return 0;
  }
}

// kiem tra neu nhu ten nay doc nhat 
function findNameDocNhat($uname, $conn){
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

function findTeacherWithApproximateName( $searchName , $conn)
{
  $similarityThreshold = 0.8;
  
  $sql = "SELECT * FROM teachers";
$result = $conn->query($sql);
$people = [];
while ($row = $result->fetch_assoc()) {
  $similarity = similar_text($row[""], $searchName);

  if ($similarity >= $similarityThreshold) {
    $people[] = $row;
  }
}

// Return the array of people found.
return $people;


}


function countNumberTeacherFemale($conn)
{
  $sql = "SELECT * FROM teachers where gioitinh='Nữ'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
$totalfemale = $stmt->rowCount();

return $totalfemale;

 
}
function countNumberTeacherMale($conn)
{
  $sql = "SELECT * FROM teachers where gioitinh='Nam'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
$totalmale = $stmt->rowCount();

return $totalmale;

 
}
function countNumberTeacher($conn)
{
  $sql = "SELECT * FROM teachers ";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
$total = $stmt->rowCount();

return $total;

 
}
?>