<?php
error_reporting(E_ALL ^ E_WARNING);
include_once("DAL/data/class.php");
include_once("../DAL/data/class.php");
function getAllClassBL($conn){
    
    return getAllClass($conn);
}

function getClassBL($conn,$idcls){
    return getClass($conn,$idcls);
}
?>