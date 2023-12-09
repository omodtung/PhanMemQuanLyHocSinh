<?php
//error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL ^ E_WARNING);
include_once("DAL/data/teacherAd.php");
include_once("../DAL/data/teacherAd.php");
include_once("DAL/data/getteacher.php");
include_once("../DAL/data/getteacher.php");


function getAllTeachersBL($conn){
    
    return getAllTeachers($conn);
}

function countFemale($conn){
    return countNumberTeacherFemale($conn);
}

function getTeacherBL($conn,$idteacher){
    return getTeacher($conn,$idteacher);
}

function findNameDocNhat2BL($uname, $conn){
    return findNameDocNhat2($uname, $conn);
}

function findNameDocNhatBL($uname, $conn){
    return findNameDocNhat($uname, $conn);
}

function findTeacherWithApproximateNameBL( $searchName , $conn){
    return findTeacherWithApproximateName( $searchName , $conn);
}

function countNumberTeacherMaleBL($conn){
    return countNumberTeacherMale($conn);
}

function countNumberTeacherBL($conn){
    return countNumberTeacher($conn);
}
?>