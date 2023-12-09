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

function getCategory()


{
    global $conn;
    $data=[];
    $query ="SELECT distinct mamonhoc FROM teachers";
$result = $conn->query($query);
if($result->num_rows > 0){
    $data = $result->fetch_all(MYSQLI_ASSOC);
}
return $data;
}


// print_r(getCategory());
?>