<?php


session_start();




if (
    isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])
) {
    if ($_SESSION['role'] == 'Admin') {

        if (
            isset($_POST['flname']) &&
            isset($_POST['maHocSinh']) &&
            isset($_POST['uname']) &&
            isset($_POST['birthdate']) &&
            isset($_POST['genderbtn']) && isset($_POST['hanhkiem'])
            && isset($_POST['grades']) && isset($_POST['classes'])





        ) {
            include_once '../../DB_connection.php';
           // include_once "../DAL/data/teacherAd.php";
            include_once "DAL/data/student.php";

            // print_r($_POST);
            // die();
// $id = $_POST["id"];
            $flname = $_POST['flname'];
            $pass = $_POST['pass'];
            $uname = $_POST['uname'];
            $birthdate = $_POST['birthdate'];

            $hanhkiem = $_POST['hanhkiem'];
            $gender =   $_POST['genderbtn'];
            $grades = $_POST['grades'];
            $diaChi = $_POST['diaChi'];
            $mahocsinh = $_POST['maHocSinh'];
            $status = 1;
            // $counting = countStatusExist($conn);

            // foreach ($_POST['grades'] as $grade) {
            //     $grades .= $grade;+
            // }
            // $lopChuNhiem = '';

            $classes = $_POST['classes'];
            // foreach ($_POST['classesArray'] as $class)
            // {
            //     $classes .= $class;

            // }
            $data = 'uname=' . $uname . '&flname=' . $flname . '&mahocSinh=' . $mahocsinh;
            if (empty($flname)) {
                $thongBao = " full Name is require";
                header("Location: ../siteAddStudent.php?error=$thongBao&$data");
                exit;
            } else if (empty($mahocsinh)) {
                $thongBao = " last Name is require";
                header("Location: ../siteAddStudent.php?error=$thongBao&$data");
                exit;
            } else if (!findNameDocNhat($uname, $conn)) {
                $thongBao = " Username Da Ton Tai Su Dung Username Khac";
                header("Location: ../siteAddStudent.php?error=$thongBao&$data");
                exit;
            } else if (empty($pass)) {
                $thongBao = " pass is require";
                header("Location: ../siteAddStudent.php?error=$thongBao&$data");
                exit;
            } else if (empty($birthdate)) {
                $thongbao = " BirthDate is required";
                header("Location: ../siteAddStudent.php?error=$thongBao&$data");
                exit;
            } else if (empty($hanhkiem)) {
                $thongbao = " hanhkiem is required";
                header("Location: ../siteAddStudent.php?error=$thongBao&$data");
                exit;
            } else if (empty($gender)) {
                $thongbao = "gender is required";
                header("Location: ../siteAddStudent.php?error=$thongBao&$data");
                exit;
            } else if (empty($grades)) {
                $thongbao = " grades is required";
                header("Location: ../siteAddStudent.php?error=$thongBao&$data");
                exit;
            } else if (empty($classes)) {
                $thongbao = " classes is required";
                header("Location: ../siteAddStudent.php?error=$thongBao&$data");
                exit;
            } else {
                //chuyen doi hashing pass 
                $pass = password_hash($pass, PASSWORD_DEFAULT);


                $sql = "INSERT INTO `students`(`username`, `password`, `mahs`, `makhoi`, `malop`, `hotenhs`, `ngaysinh`, `gioitinh`, `diachi`,`hanhkiem`,`status`)  VALUES(?,?,?,?,?,?,?,?,?,?,?)";

                // $sql2 = "INSERT INTO `avgscore` (`student_id`) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$uname, $pass, $mahocsinh, $grades, $classes, $flname, $birthdate, $gender, $diaChi, $hanhkiem, $status]);

                // $stmt2 = $conn->prepare($sql2);
                // $stmt2->execute([$id]);




                $thongBao = " Tao Thanh Cong";
                header("Location: ../siteAddStudent.php?success=$thongBao");
                exit;
            }
        } else {
            $thongBao = " xay Ra loi 144442232324";
            header("Location: ../siteAddStudent.php?error=$thongBao");

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
