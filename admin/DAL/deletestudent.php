<?php

//session_start();

        include_once("../../DB_connection.php");
        $id = $_GET['id'];
        $sql = "UPDATE students SET status = 0 WHERE id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header("Location: ../studentUI.php");
        exit;
        //exit;
?>