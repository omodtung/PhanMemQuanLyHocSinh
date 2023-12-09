<?php
error_reporting(E_ALL ^ E_WARNING);
include_once("DAL/data/student.php");
include_once("../DAL/data/student.php");
function getAllStudentsBL($conn){
    
    return getAllStudents($conn);
}

function getStudentUsingIdBL( $conn , $idStudent){
    return getStudentUsingId( $conn , $idStudent);
}

function countNumberStudentFemaleBL($conn){
    return countNumberStudentFemale($conn);
}

function countNumberStudentMaleBL($conn){
    return countNumberStudentMale($conn);
}

function countNumberStudentBL($conn){
    return countNumberStudent($conn);
}

function countHocLucGioiBL($conn){
    return countHocLucGioi($conn);
}

function countHocLucKemBL($conn){
    return countHocLucKem($conn);
}

function findNameDocNhatHsBL($uname, $conn){
    return findNameDocNhatHs($uname, $conn);
}

?>