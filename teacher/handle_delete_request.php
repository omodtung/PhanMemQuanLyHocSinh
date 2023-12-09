<?php
include "../DB_connection.php";

if (isset($_POST['student_id'])) {
    $studentId = $_POST['student_id'];

    $sql = "UPDATE students SET status = 0 WHERE mahs = :student_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':student_id', $studentId, PDO::PARAM_STR);
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
