<?php
require('../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\IOFactory;

$fileType = strtolower(pathinfo($_FILES["studentScoresFile"]["name"], PATHINFO_EXTENSION));

// Check if file is an Excel file
if($fileType != "xlsx" && $fileType != "xls") {
    echo "Sorry, only XLS & XLSX files are allowed.";
    exit;
}

try {
    // Read the Excel file directly from the uploaded tmp location
    $spreadsheet = IOFactory::load($_FILES["studentScoresFile"]["tmp_name"]);
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();
} catch (Exception $e) {
    echo "Error reading the Excel file: " . $e->getMessage();
    exit;
}

array_shift($rows);

// Connect to database using PDO
$sName = "localhost";
$uName = "root";
$pass  = "";
$db_name = "test7";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach($rows as $row) {
        // Validate that id_subject is not null or empty
        if (empty($row[0])) {
            echo "Error: id_subject is null or empty for student_code " . $row[1] . "<br>";
            continue;  // Skip this row and continue with the next
        }
        
        $sql = "UPDATE score 
                SET diem15=?, diem45=?, thi=?, tbm=? 
                WHERE student_code=? AND id_subject=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$row[2], $row[3], $row[4], $row[5], $row[1], $row[0]]);
    }
    echo "Data updated successfully for ". basename($_FILES["studentScoresFile"]["name"]). " in the database.";
    $response['status'] = 'success';
    $response['message'] = 'Sorry, only XLS & XLSX files are allowed.';

} catch(PDOException $e) {
    echo "Error: ". $e->getMessage();
    exit;
} finally {
    $conn = null;  // Close the database connection
}