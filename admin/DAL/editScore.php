<?php


session_start();



            include_once '../../DB_connection.php';

            $mahocsinh = $_SESSION['mahocsinh'];
            $id = $_GET['id'];
            
            $diem15 = $_POST['diem15'];

            $diem45  = $_POST['diem45'];
            $thi = $_POST['thi'];
            
            $sql = "UPDATE score SET diem15='$diem15',diem45='$diem45',thi='$thi' WHERE id_score = $id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            
            $_SESSION['sucsess'] = $id;
        
                header("Location: ../scoreViewUI.php");

                
                exit;

?>