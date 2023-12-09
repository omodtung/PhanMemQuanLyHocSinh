<?php


session_start();

// print_r($_POST);
// die( );


if (
    isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])
) {
    if ($_SESSION['role'] == 'Admin') {

        if (
            isset($_POST['flname']) &&
            isset($_POST['idGV']) &&
            isset($_POST['uname']) &&
            isset($_POST['pass']) &&
            isset($_POST['subjects']) &&
            isset($_POST['grades'])
            && isset($_POST['birthdate']) && isset($_POST['genderbtn'])



        ) {
            include_once '../../DB_connection.php';
            include_once "../DAL/data/teacherAd.php";
        

            $flname =  $_POST['flname'];

            $uname = $_POST['uname'];
            $pass = $_POST['pass'];

            $birthdate  = $_POST['birthdate'];
            $gender = $_POST['genderbtn'];
            $idgv  =  $_POST['idGV'];


            $diaChi= $_POST['diaChi'];


            // print_r($_POST);
            // die( );

            $grades = "";
            foreach ($_POST['grades'] as $grade) {
                $grades .= $grade;
            }
            // $lopChuNhiem = '';

            $subjects = "";
            foreach ($_POST['subjects'] as $subject) {
                $subjects .= $subject;
            }
           $data = 'uname=' . $uname . '&flname=' . $flname . '&idGV' . $idgv. '&pass' . $pass;

            if (empty($flname)) {
                $thongBao = " ful Name is require";
                header("Location: ../siteTeacherAdd.php?error=$thongBao&$data");
                exit;
            } else if (empty($idgv)) {
                $thongBao = " ma giao vien  is require";
                header("Location: ../siteTeacherAdd.php?error=$thongBao&$data");
                exit;
            } else if (!findNameDocNhat($uname, $conn)) {
                $thongBao = " Username Da Ton Tai Su Dung Username Khac";
                header("Location: ../siteTeacherAdd.php?error=$thongBao&$data");
                exit;
            } else if (empty($pass)) {
                $thongBao = " pass is require";
                header("Location: ../siteTeacherAdd.php?error=$thongBao&$data");
                exit;
            } 
            
            else if (empty($birthdate))
            {
                $thongBao = " pass is require";
                header("Location: ../siteTeacherAdd.php?error=$thongBao&$data");
                exit;
            }

            else if (empty($gender))
            {
                $thongBao = " gender is require";
                header("Location: ../siteTeacherAdd.php?error=$thongBao&$data");
                exit;
            }
            else if(empty($grades))
            {
                $thongBao = " grades is require";
                header("Location: ../siteTeacherAdd.php?error=$thongBao&$data");
                exit;
            }
            else if (empty($subject))
            {
                $thongBao = " subjects is require";
                header("Location: ../siteTeacherAdd.php?error=$thongBao&$data");
                exit;
            }

            else {
                //chuyen doi hashing pass 
                include_once("../DAL/addTeacher.php");





                $thongBao = " Tao Thanh Cong";
                header("Location: ../siteTeacherAdd.php?success=$thongBao");
                exit;
            }
        } else {
            $thongBao = " xay Ra loi 144442232324";
            header("Location: ../siteTeacherAdd.php?error=$thongBao");
            exit;
        }
    } else {
        header("Location: ../../logout.php");
        exit;
    }
} else {

    header("Location: ../../loguot.php");
    exit;
}
