<?php
error_reporting(E_ALL ^ E_WARNING);
include_once("DAL/data/schedule.php");
include_once("../DAL/data/schedule.php");
function getScheduleBL($conn,$idsche){
    
    return getSchedule($conn,$idsche);
}

function findscheduleBL($uname, $conn){
    return findschedule($uname, $conn);
}

function getAllSchedulesBL($conn){
    return getAllSchedules($conn);
}

function getScheduleFromBL($conn,$idteach){
    return getScheduleFrom($conn,$idteach);
}

function getScheduleFromClassBL($conn,$idclass){
    return getScheduleFromClass($conn,$idclass);
}

?>