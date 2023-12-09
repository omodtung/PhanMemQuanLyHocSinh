<?php
session_start();

if(isset($_GET["indexFilterScore"])){
    $_SESSION['openfilter2'] = "open";
    header('HTTP/1.1 307 Temporary Redirect');
    header("Location: ../scoreViewUI.php");
}
exit;
?>