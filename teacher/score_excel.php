<?php
include "../DB_connection.php";
require __DIR__ . '/../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    // Fetch detailed scores based on the student ID
    $sql = "SELECT students.mahs, students.hotenhs, subjects.*, score.*
    FROM students
    JOIN score ON students.mahs = score.student_code
    JOIN subjects ON subjects.subject_id = score.id_subject
    WHERE score.student_code = ?";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$student_id]);
    $student_scores = $stmt->fetchAll(PDO::FETCH_ASSOC);


$spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the headers for the Excel columns
    $sheet->setCellValue('A1', 'Môn');
    $sheet->setCellValue('B1', 'Điểm kiểm tra 15 phút');
    $sheet->setCellValue('C1', 'Điểm kiểm tra 45');
    $sheet->setCellValue('D1', 'Điểm thi');
    $sheet->setCellValue('E1', 'Điểm trung bình môn');

    // Add the data to the spreadsheet
    $row = 2;
    foreach ($student_scores as $score) {
        $sheet->setCellValue('A' . $row, $score['subject']);
        $sheet->setCellValue('B' . $row, $score['diem15']);
        $sheet->setCellValue('C' . $row, $score['diem45']);
        $sheet->setCellValue('D' . $row, $score['thi']);
        $sheet->setCellValue('E' . $row, $score['tbm']);
        $row++;
    }

    // Write an .xlsx file
    $writer = new Xlsx($spreadsheet);

    // You can set a filename for the Excel file
    $filename = 'student-scores.xlsx';

    ob_end_clean(); // This will clean the output buffer
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'. $filename .'"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}
?>



