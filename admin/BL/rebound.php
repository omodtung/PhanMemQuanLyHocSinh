<?php
session_start();

if(isset($_GET["indexFilter"])){
    $_SESSION['openfilter'] = "open";
    header('HTTP/1.1 307 Temporary Redirect');
    header("Location: ../teacherNewUI.php");
}
exit;
?>