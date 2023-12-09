<?php


session_start();




// if (
//     isset($_SESSION['admin_id']) &&
//     isset($_SESSION['role'])
// ) {
//     if ($_SESSION['role'] == 'Admin') {

//         if (
//             isset($_POST['nameClass']) &&

//             isset($_POST['idclass']) &&
//             isset($_POST['idnamhoc']) &&
//             isset($_POST['grades'])



//         ) {
//             include_once '../../DB_connection.php';
        


            $nameClasses = $_POST['nameClass'];

            $idclass =  $_POST['idclass'];
            $idnamhoc = $_POST['idnamhoc'];
            $grades = $_POST['grades'];
$status=1;

            // }







            $sql = "INSERT INTO class ( `makhoi`,`classname`,`manamhoc`,`number`,`status`)  VALUES(?,?,?,?,?)";


            $stmt = $conn->prepare($sql);
            $stmt->execute([$nameClasses, $idclass, $idnamhoc, $grades,$status]);





//             $thongBao = " Tao Thanh Cong";
//             header("Location: ../addClassSite.php?success=$thongBao");
//             exit;
//         } else {
//             $thongBao = " xay Ra loi 144442232324";
//             header("Location: ../addClassSite.php?error=$thongBao");

//             exit;
//         }
//     } else {
//         header("Location: ../../logout.php");
//         exit;
//     }
// } else {

//     header("Location: ../../loguot.php");
//     exit;
// }
