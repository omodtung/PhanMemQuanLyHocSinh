<?php
session_start();

if(isset($_GET["indexFilterStudent"])){
    $_SESSION['openfilter1'] = "open";
    header('HTTP/1.1 307 Temporary Redirect');
    header("Location: ../studentUI.php");
  
}
exit;
?>