<?php

session_start();


if(isset($_SESSION['admin_id']) && isset($_SESSION['role']))
{
    if ($_SESSION['role']=='Admin')
    {
        include_once("../DAL/deleteteacher.php");
        
        header("Location: ../teacherNewUI.php");
        exit;
    }
}

?>