<?php


session_start();


if(isset($_SESSION['admin_id']) && isset($_SESSION['role']))
{
    if ($_SESSION['role']=='Admin')
    {
        include_once "../../DB_connection.php";
        $id = $_GET['id'];

        if(!isset($_POST['teacherid']) || empty($_POST['teacherid'])){
            header("Location: ../schedule.php?id=$id&error=Teachers Id Error!");
        }
        else if(!isset($_POST['starttime']) || empty($_POST['starttime'])){
            header("Location: ../schedule.php?id=$id&error=Start Time Error!");
        }
        else if(!isset($_POST['endtime']) || empty($_POST['endtime'])){
            header("Location: ../schedule.php?id=$id&error=End Time Error!");
        }
        else if(!isset($_POST['workdate']) || empty($_POST['workdate'])){
            header("Location: ../schedule.php?id=$id&error=Work Date Error!");
        }
        else if(!isset($_POST['class']) || empty($_POST['class'])){
            header("Location: ../schedule.php?id=$id&error=Class Error!");
        }

        else{
        
        header('HTTP/1.1 307 Temporary Redirect');
        header("Location: ../DAL/schedule-edit.php?id=$id");
        }
    }
}

?>