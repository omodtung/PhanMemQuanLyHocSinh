<?php 
session_start();
if (isset($_SESSION['teacher_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Teacher') {
    	

if (isset($_POST['old_pass']) &&
    isset($_POST['new_pass'])   &&
    isset($_POST['c_new_pass']) ) {
    
    include '../DB_connection.php';

    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $c_new_pass = $_POST['c_new_pass'];

    $teacher_id = $_SESSION['teacher_id'];
    
    echo($old_pass);
    echo($new_pass);
    echo($c_new_pass);
    // hashing the password
    $new_pass = password_hash($new_pass,PASSWORD_BCRYPT);

    $sql = "UPDATE teachers SET
            password = ?
            WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$new_pass, $teacher_id]);
    $sm = "The password has been changed successfully!";
    header("Location: teacher_site.php?psuccess=$sm");
    exit;
    
  }else {
  	$em = "An error occurred";
    header("Location: ../pass.php?error=$em");
    exit;
  }

  }else {
    header("Location: ../../logout.php");
    exit;
  } 
}else {
	header("Location: ../../logout.php");
	exit;
} 