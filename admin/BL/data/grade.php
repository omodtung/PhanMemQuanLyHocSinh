<?php
error_reporting(E_ALL ^ E_WARNING);
include_once("DAL/data/grade.php");
include_once("../DAL/data/grade.php");
function getAllGradeBL($conn){
    
    return getAllGrade($conn);
}

function getGradeByIdBL($grade_id, $conn){
    
    return getGradeById($grade_id, $conn);
}
?>