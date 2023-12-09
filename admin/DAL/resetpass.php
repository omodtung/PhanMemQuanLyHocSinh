<?php
    include_once("../../DB_connection.php");
    
    $id = ($_GET['table'] == 'teachers') ? $_GET['idteach'] : $_GET['idstudent'];
    $pass = password_hash("123456789",PASSWORD_BCRYPT);
    $sql = "UPDATE teachers SET password='$pass' WHERE id = $id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo("123456789");
?>