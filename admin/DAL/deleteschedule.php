<?php




        $sql = "DELETE FROM schedule WHERE ID_Schedule = ".$_GET["id"];
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header("Location: ../schedule.php");
        exit;
?>