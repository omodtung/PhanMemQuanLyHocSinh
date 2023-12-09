<?php
define("teacherTable","teachers");
$hostname = "localhost";
$username = "root";
$password = "";
$databasename = "test7";


$conn = mysqli_connect($hostname, $username, $password, $databasename);
if(!$conn)
{
    die("unanble to connect database".mysqli_connect_error());
}



// try {
//     $conn = new mysqli('localhost', 'root', '', 'test7');

//     // Check connection for errors
//     if ($conn->connect_error) {
//         throw new Exception('Failed to connect to database: ' . $conn->connect_error);
//     }
// } catch (Exception $e) {
//     die($e->getMessage());
// }

?>