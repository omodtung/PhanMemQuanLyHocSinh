<?php


session_start();


if(isset($_SESSION['admin_id']) && isset($_SESSION['role']))
{
    if ($_SESSION['role']=='Admin')
    {
        include_once "../../DB_connection.php";
        $id = $_GET['id'];

        if(!isset($_POST['nameClass']) || empty($_POST['nameClass'])){
            header("Location: ../schedule.php?id=$id&error=Class Name Error!");
        }
        else if(!isset($_POST['makhoi']) || empty($_POST['makhoi'])){
            header("Location: ../schedule.php?id=$id&error=Ma Khoi Error!");
        }
        else if(!isset($_POST['manamhoc']) || empty($_POST['manamhoc'])){
            header("Location: ../schedule.php?id=$id&error=Ma Nam Hoc Error!");
        }
        

        else{
        
        header('HTTP/1.1 307 Temporary Redirect');
        header("Location: ../DAL/class-edit.php?id=$id");
        }
    }
}

?>