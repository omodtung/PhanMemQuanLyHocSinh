<?php

try {
    $conn = new mysqli('localhost', 'root', '', 'test7');

    // Check connection for errors
    if ($conn->connect_error) {
        throw new Exception('Failed to connect to database: ' . $conn->connect_error);
    }
} catch (Exception $e) {
    die($e->getMessage());
}

if(isset($_POST["filter1"]))
{
    $filterDataByCategory = filterDataByCategory();

}


function filterDataByCategory() {
    $filterByCategory = $_POST['filterByCategory1'];
    global $conn;
    
    $data =[];
    if(!empty($filterByCategory)){
    
        $query = "SELECT * FROM students WHERE malop= '$filterByCategory'";
     
     
        $result = $conn->query($query);
    
        if($result->num_rows > 0) {
          $data = $result->fetch_all(MYSQLI_ASSOC);;
        
        } 
   } 
   return $data;
}


?>