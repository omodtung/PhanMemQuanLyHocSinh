<?php
function getAllClass($conn){
    $sql = "SELECT * FROM class ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
 
    if ($stmt->rowCount() >= 1) {
     
      $classes= $stmt->fetchAll();
 
      return $classes;
    }else {
        return 0;
    }
 }

 function getClass($conn,$idcls){
  $sql = "SELECT * FROM class WHERE classname = '$idcls'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  if ($stmt->rowCount() == 1) {
    $schedule = $stmt->fetch();
    return $schedule;
  }else {
    return 0;
  }
}
 

?>