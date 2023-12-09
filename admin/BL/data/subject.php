<?php
error_reporting(E_ALL ^ E_WARNING);
include_once("DAL/data/subject.php");
include_once("../DAL/data/subject.php");
function getAllSubjectsBL($conn){
    
    return getAllSubjects($conn);
}

function getSubjectByIdBL($subject_id, $conn){
    
    return getSubjectById($subject_id, $conn);
}

function getSubjectBySubject_codeBL ($subject_code, $conn){
    
    return getSubjectBySubject_code ($subject_code, $conn);
}
?>