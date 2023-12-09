<?php


session_start();


if(isset($_SESSION['admin_id']) && isset($_SESSION['role']))
{
    if ($_SESSION['role']=='Admin')
    {
        include_once "../../DB_connection.php";
        
        include_once "../DAL/data/grade.php";
        $id = $_GET['id'];
        $hotenhs = $_POST['hotenhs'];
        //$lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $brthday = $_POST['birthdate'];
        $gender = $_POST['genderbtn'];
        $hanhkiem = $_POST['hanhkiem'];
        //$hocluc = $_POST['hocluc'];
        $grade = $_POST['grade'];
        $diachi = $_POST['diachi'];
        $class = $_POST['class'];
        $grades = "";
        $brthday = date("Y-m-d", strtotime($brthday));


        if(!isset($_POST['hotenhs']) || empty($hotenhs)){
            header("Location: ../studentUI.php?idteach=$id&error=Name is Empty!");
        }
        else if(!isset($_POST['uname']) || empty($uname)){
            header("Location: ../studentUI.php?idteach=$id&error=Username is Empty!");
        }
        else if(!isset($_POST['hanhkiem']) || empty($_POST['hanhkiem'])){
            header("Location: ../studentUI.php?idteach=$id&error=Hanh Kiem is Empty!");
        }
        else if(!isset($_POST['diachi']) || empty($_POST['diachi'])){
            header("Location: ../studentUI.php?idteach=$id&error=Address is Empty!");
        }
        else if(!isset($_POST['birthdate']) || empty($_POST['birthdate'])){
            header("Location: ../studentUI.php?idteach=$id&error=Address is Empty!");
        }
        // else if(!isset($_POST['hocluc']) || empty($_POST['hocluc'])){
        //     header("Location: ../student-edit.php?idteach=$id&error=Hoc Luc is Empty!");
        // }

        else{
        
        include_once("../DAL/student-edit.php");
        header("Location: ../studentUI.php?sucsess=$id");
        }
    }
}

?>