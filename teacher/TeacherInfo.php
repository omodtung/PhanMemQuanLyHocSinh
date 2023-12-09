<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Info</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your CSS styles */
        /* ... */
    </style>
</head>
<body>
    <?php
    include "../DB_connection.php";
    $teacherinfo = [];

    if (isset($_GET['teacher_info'])) {
        $teacherid = $_GET['teacher_info'];
        // $sql = "SELECT hoten, magv, mamonhoc, ngaysinh, gioitinh, diachi, image FROM teachers WHERE magv = ?";
        $sql = "SELECT hoten, magv, mamonhoc, ngaysinh, gioitinh, diachi FROM teachers WHERE magv = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$teacherid]);
        $teacherinfo = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    ?>

    <!-- CV Layout -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <?php if (isset($teacherinfo['image']) && $teacherinfo['image']): ?>
                    <!-- Decode the image data and display it as a Base64-encoded image -->
                    <img src="data:image/jpeg;base64,<?= base64_encode($teacherinfo['image']) ?>" alt="Teacher Photo" class="img-fluid rounded-circle">

                <?php else: ?>
                    <!-- Display a default image if the teacher's photo is not available -->
                    <img src="default_photo_path.jpg" alt="Default Teacher Photo" class="img-fluid rounded-circle">
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <!-- Display other teacher information fields -->
                <h2><?= $teacherinfo['hoten'] ?? '' ?></h2>
                <p><strong>Mã Giáo Viên:</strong> <?= $teacherinfo['magv'] ?? '' ?></p>
                <p><strong>Môn Học:</strong> <?= $teacherinfo['mamonhoc'] ?? '' ?></p>
                <p><strong>Ngày Sinh:</strong> <?= $teacherinfo['ngaysinh'] ?? '' ?></p>
                <p><strong>Giới Tính:</strong> <?= ($teacherinfo['gioitinh'] ?? '') == 'M' ? 'Nam' : 'Nữ' ?></p>
                <p><strong>Địa Chỉ:</strong> <?= $teacherinfo['diachi'] ?? '' ?></p>
                <!-- More fields here -->
            </div>
        </div>

        <!-- Form for PDF Export -->
        <form method="POST" action="generate_pdf.php">
            <input type="hidden" name="teacher_id" value="<?= $teacherid ?>">
            <button type="submit" class="btn btn-primary mt-3">Export to PDF</button>
        </form>
    </div>

    <!-- Include Bootstrap JS (Optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
