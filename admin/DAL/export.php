<?php 
 


// Load the database configuration file 
include_once '../../DB_connection.php'; 
 
// include_once XLSX generator library 
require_once '../inc/PhpXlsxGenerator.php'; 
 
// Excel file name for download 
$fileName = "teachers-data_" . date('Y-m-d') . ".xlsx"; 
 
// Define column names 
 
if(isset($_GET["searched"]) && $_GET["searched"] != ""){
    $excelData[] = array('ID', 'magv', 'username', 'hoten','mamonhoc','makhoi','ngaysinh', 'gioitinh', 'diachi', 'STATUS'); 
    $sql = "SELECT * FROM teachers WHERE hoten LIKE '". $_GET['searched'] ."%' ORDER BY id ASC";
}
else if(isset($_GET["studentsearched"]) && $_GET["studentsearched"] != ""){
    $fileName = "students-data_" . date('Y-m-d') . ".xlsx"; 
    $excelData[] = array('id', 'username', 'mahs', 'makhoi','malop','hotenhs','hanhkiem','HocLuc','ngaysinh', 'gioitinh', 'diachi', 'STATUS'); 
    $sql = "SELECT * FROM students JOIN avgscore ON students.id = avgscore.student_id WHERE hotenhs LIKE '". $_GET['studentsearched'] ."%' ORDER BY id ASC";
}
else if(isset($_GET["student"]) && $_GET["student"] != ""){
    $fileName = "students-data_" . date('Y-m-d') . ".xlsx"; 
    $excelData[] = array('id', 'username', 'mahs', 'makhoi','malop','hotenhs','hanhkiem','HocLuc','ngaysinh', 'gioitinh', 'diachi', 'STATUS'); 
    $sql = "SELECT students.*,avgscore.HocLuc FROM students JOIN avgscore ON students.id=avgscore.student_id WHERE status = 1 ORDER BY id ASC"; 
}
else if(isset($_GET["teacher"]) && $_GET["teacher"] != ""){
    $excelData[] = array('ID', 'magv', 'username', 'hoten','mamonhoc','makhoi','ngaysinh', 'gioitinh', 'diachi', 'STATUS'); 
    $sql = "SELECT * FROM teachers WHERE status = 1 ORDER BY id ASC"; 
}
else if(isset($_GET["schedule"]) && $_GET["schedule"] != ""){
    $fileName = "schedules-data_" . date('Y-m-d') . ".xlsx"; 
    $excelData[] = array('ID', 'teacher id', 'Ho Ten', 'Start Time','End Time','Work Date','Class'); 
    $sql = "SELECT * FROM schedule ORDER BY 'id' ASC"; 
}
else if(isset($_GET["schedulesearched"]) && $_GET["schedulesearched"] != ""){
    $fileName = "schedules-data_" . date('Y-m-d') . ".xlsx"; 
    $excelData[] = array('ID', 'teacher id', 'Ho Ten', 'Start Time','End Time','Work Date','Class'); 
    $sql = "SELECT * FROM schedule WHERE 'Ho Ten' LIKE '". $_GET['schedulesearched'] ."%' ORDER BY ID_Schedule ASC";
}


$stmt = $conn->prepare($sql);
$stmt->execute();
if($stmt->rowCount() > 0){ 
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
        $status = ($row['status'] == 1)?'Active':'Inactive'; 
        if(isset($_GET["studentsearched"]) || isset($_GET["student"])) $lineData = array($row['id'], $row['username'], $row['mahs'], $row['makhoi'],$row['malop'],$row['hotenhs'],$row['hanhkiem'],$row['HocLuc'], $row['ngaysinh'], $row['gioitinh'], $row['diachi'], $status);  
        else if(isset($_GET["searched"]) || isset($_GET["teacher"])) $lineData = array($row['id'], $row['magv'], $row['username'], $row['hoten'],$row['mamonhoc'],$row['makhoi'], $row['ngaysinh'], $row['gioitinh'], $row['diachi'], $status);  
        else if(isset($_GET['schedulesearch']) || isset($_GET["schedule"])) $lineData = array($row["ID_Schedule"], $row["TeacherId"], $orw["Ho Ten"], $row["StartTime"], $row["EndTime"], $row["WorkDate"], $row["Class"]);
        $excelData[] = $lineData; 
    } 
} 
 
// Export data to excel and download as xlsx file 
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
$xlsx->downloadAs($fileName); 
 
exit; 
 
?>