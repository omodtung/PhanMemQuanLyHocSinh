<?php
include "../DB_connection.php";
require __DIR__ . '/../vendor/autoload.php';


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

    // Begin HTML content
    $html .= "<h1>Điểm chi tiết của học sinh: " . ($student_scores[0]['hotenhs'] ?? 'N/A') . "</h1>";
    $html .= '<table border="1" cellpadding="10" cellspacing="0">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>Môn</th>';
    $html .= '<th>Điểm kiểm tra 15 phút</th>';
    $html .= '<th>Điểm kiểm tra 45</th>';
    $html .= '<th>Điểm thi</th>';
    $html .= '<th>Điểm trung bình môn</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    foreach ($student_scores as $score) {
        $html .= '<tr>';
        $html .= '<td>' . ($score['subject'] ?? 'N/A') . '</td>';
        $html .= '<td>' . strval($score['diem15'] ?? 'N/A') . '</td>';
        $html .= '<td>' . strval($score['diem45'] ?? 'N/A') . '</td>';
        $html .= '<td>' . strval($score['thi'] ?? 'N/A') . '</td>';
        $html .= '<td>' . strval($score['tbm'] ?? 'N/A') . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';
}


// Ensure the HTML content is valid
if ($html) {
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output('score.pdf', 'I'); // This will output the PDF in-browser
} else {
    echo "No data available for the specified student ID.";
}

?>
