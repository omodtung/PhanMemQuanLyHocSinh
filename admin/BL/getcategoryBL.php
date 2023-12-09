<?php
error_reporting(E_ALL ^ E_WARNING);
include_once("DAL/getCategoriesStudent.php");
include_once("..DAL/getCategoriesStudent.php");
function getCategoriesBL()
{
    return getCategory();

}
?>