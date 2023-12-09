<?php
// Include your database connection file
include "../DB_connection.php";

// Check if all the necessary POST data exists
if (isset($_POST['score_id']) && !empty($_POST['diem15']) && !empty($_POST['diem45']) && !empty($_POST['thi']) && !empty($_POST['tbm'])) {

    // Get the values from the POST data
    $score_id = $_POST['score_id'];
    $diem15 = $_POST['diem15'];
    $diem45 = $_POST['diem45'];
    $thi = $_POST['thi'];
    $dtb = $_POST['tbm'];

    // if (!is_numeric($diem15) || !is_numeric($diem45) || !is_numeric($thi) || !is_numeric($tbm)) {
    //     header("Location: Score_student.php?error=score_cant_be_null&student_id=" . $_POST['student_id']);
    //     exit();
    // }

    // SQL query to update the scores in the database
    $sql = "UPDATE score SET diem15 = ?, diem45 = ?, thi = ?, tbm = ? WHERE id_score = ?"; 

    // Prepare the SQL statement and execute it
    $stmt = $conn->prepare($sql);

    // Execute the statement with the values
    $success = $stmt->execute([$diem15, $diem45, $thi, $dtb, $score_id]);
    
    // Check if the update was successful
    if ($success) {
        echo "Scores updated successfully!";
        // echo $score_id;
        // echo $diem15;
        // echo $diem45;
        // echo $thi;
    } else {
        echo "Error updating scores!";
    }

    // Redirect back to the score details page to see the changes
    header("Location: Score_student.php?student_id=" . $_POST['student_id']);
    exit();
} else {
    header("Location: Score_student.php?error=score_cant_be_null&student_id=" . $_POST['student_id']);
    exit();
}
?>
