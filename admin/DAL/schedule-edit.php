<?php


session_start();



            include_once '../../DB_connection.php';
            
            $id = $_GET['id'];
            
            $class = $_POST['class'];

            $EndTime  = $_POST['endtime'];
            $StartTime = $_POST['starttime'];
            
            $workdate = $_POST['workdate'];

            $teacherid= $_POST['teacherid'];


                $sql = "UPDATE `schedule` SET TeacherId = $teacherid,HoTen = (SELECT hoten FROM teachers WHERE id = $teacherid),StartTime = '$StartTime',EndTime = '$EndTime',WorkDate = '$workdate',Class = '$class' WHERE ID_Schedule = $id";

                $stmt = $conn->prepare($sql);
                $stmt->execute();





                
                $_SESSION['sucsess'] = $id;
                header("Location: ../schedule.php");
                exit;