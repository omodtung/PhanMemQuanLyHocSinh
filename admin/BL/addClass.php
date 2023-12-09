<?php


session_start();




if (
    isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])
) {
    if ($_SESSION['role'] == 'Admin') {

        if (
            isset($_POST['nameClass']) &&

            isset($_POST['idclass']) &&
            isset($_POST['idnamhoc']) &&
            isset($_POST['grades'])



        ) {
            include_once '../../DB_connection.php';
            include_once "../DAL/data/teacherAd.php";

            // print_r($_POST);
            // die();

            include_once "../DAL/data/class.php";


            // print_r($_POST);
            // die();


            $nameClasses = $_POST['nameClass'];

            $idclass =  $_POST['idclass'];
            $idnamhoc = $_POST['idnamhoc'];
            $grades = $_POST['grades'];


            // }

            if(empty($nameClasses))
            {
                $thongBao = "  Name Class is require";
                header("Location: ../addClassSite.php?error=$thongBao&$data");
                exit;
            }

            else if(empty($idclass))
            {
                $thongBao = "  Ten Lop is require";
                header("Location: ../addClassSite.php?error=$thongBao&$data");
                exit;
            }
            else if (empty ($idnamhoc))
            {
                $thongBao = "  Nam Hoc is require";
                header("Location: ../addClassSite.php?error=$thongBao&$data");
                exit;
            }
            else if ( empty($grades))
            {
                $thongBao = "  Khoi is require";
                header("Location: ../addClassSite.php?error=$thongBao&$data");
                exit;
            }


            else
            {
                include_once("../DAL/addClass.php");





                $thongBao = " Tao Thanh Cong";
                header("Location: ../addClassSite.php?success=$thongBao");
                exit;
            }





        } else {
            $thongBao = " xay Ra loi 144442232324";
            header("Location: ../addClassSite.php?error=$thongBao");

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
