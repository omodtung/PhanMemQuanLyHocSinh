<?php
error_reporting(E_ALL ^ E_WARNING);
include_once("DAL/data/score.php");
include_once("../DAL/data/score.php");
function getAllScoreBL($conn, $id){
    
    return getAllScore($conn, $id);
}

function getScoreBL($conn,$id_score){
    
    return getScore($conn,$id_score);
}

?>