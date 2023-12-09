<?php
error_reporting(E_ALL ^ E_WARNING);
include_once("DAL/data/timetable.php");
include_once("../DAL/data/timetable.php");
function getAllTimeTableBL($conn){
    
    return getAllTimeTable($conn);
}

?>