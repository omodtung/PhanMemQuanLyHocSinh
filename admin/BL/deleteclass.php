<?php

session_start();


if(isset($_SESSION['admin_id']) && isset($_SESSION['role']))
{
    if ($_SESSION['role']=='Admin')
    {
        include_once '../../DB_connection.php';
        include_once("../DAL/deleteclass.php");
        header("Location: ../classUi.php");
        exit;
    }
}

?>