<?php
include "../DB_connection.php";
require __DIR__ . '/../vendor/autoload.php';

$teacherinfo = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['teacher_id'])) {
    $teacherid = $_POST['teacher_id'];
    $sql = "SELECT * FROM teachers WHERE teachers.magv = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$teacherid]);
    $teacherinfo = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if there is an image and encode it
    $imageData = isset($teacherinfo['image']) ? base64_encode($teacherinfo['image']) : null;
    $imageHtml = $imageData ? '<img src="data:image/jpeg;base64,' . $imageData . '" style="width: 100px; height: 100px;">' : '';
}
$stylesheet = <<<CSS
body {
    font-family: 'Helvetica', sans-serif;
    color: #333;
    line-height: 1.6;
}
h2 {
    color: #000;
    margin-bottom: 0;
}
p {
    margin: 5px 0;
}
img {
    border-radius: 50%;
    margin-bottom: 10px;
}
.container {
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 5px;
    background: #fff;
}
.section {
    margin-bottom: 20px;
}
.section-title {
    font-weight: bold;
    color: #555;
    margin-bottom: 5px;
    text-transform: uppercase;
}
.section-content {
    margin-left: 20px;
}
CSS;

$html = "<div class='container'>
            <div class='row'>
                <div class='col-md-4'>
                    $imageHtml
                </div>
                <div class='col-md-8'>
                    <h2>" . ($teacherinfo['hoten'] ?? 'N/A') . "</h2>
                    <div class='section'>
                        <div class='section-title'>Mã Giáo Viên:</div>
                        <div class='section-content'>" . ($teacherinfo['magv'] ?? 'N/A') . "</div>
                    </div>
                    <div class='section'>
                        <div class='section-title'>Môn Học:</div>
                        <div class='section-content'>" . ($teacherinfo['mamonhoc'] ?? 'N/A') . "</div>
                    </div>
                    <div class='section'>
                        <div class='section-title'>Ngày Sinh:</div>
                        <div class='section-content'>" . ($teacherinfo['ngaysinh'] ?? 'N/A') . "</div>
                    </div>
                    <div class='section'>
                        <div class='section-title'>Giới Tính:</div>
                        <div class='section-content'>" . (($teacherinfo['gioitinh'] ?? '') == 'M' ? 'Nam' : 'Nữ') . "</div>
                    </div>
                    <div class='section'>
                        <div class='section-title'>Địa Chỉ:</div>
                        <div class='section-content'>" . ($teacherinfo['diachi'] ?? 'N/A') . "</div>
                    </div>
                </div>
            </div>
        </div>";

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($stylesheet, 1); // The parameter 1 tells mPDF this is CSS
$mpdf->WriteHTML($html, 2); // The parameter 2 tells mPDF this is HTML
$mpdf->Output('teacher_cv.pdf', 'I');

?>