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
 

?>