<?php


session_start();



            include_once '../../DB_connection.php';
            

            
            $class = $_POST['class'];

            $EndTime  = $_POST['endtime'];
            $StartTime = $_POST['starttime'];
            
            $workdate = $_POST['workdate'];

            $teacherid= $_POST['teacherid'];


                $sql = "INSERT INTO `schedule` (TeacherId,HoTen,StartTime,EndTime,WorkDate,Class) VALUES ( ?, (SELECT hoten FROM teachers WHERE id = ?), ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);
                $stmt->execute([ $teacherid, $teacherid, $StartTime, $EndTime, $workdate, $class]);





                
                $_SESSION['addsucsess'] = $teacherid;
                header("Location: ../schedule.php");
                exit;