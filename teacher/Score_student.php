<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Scores</title>
    
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f5f7;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 123, 255, 0.1);
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
            color: white;
            box-shadow: 0 4px 6px rgba(255, 193, 7, 0.1);
        }

        .modal-content {
            border-radius: 8px;
        }
    </style>

</head>

<script type="text/javascript">
    // Check for URL parameters for errors
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');

        // If there's an error, display an alert
        if (error === 'score_cant_be_null') {
            alert('Nhập thiếu cột điểm');
        }
    }
</script>

<body>
    <?php
    include "../DB_connection.php";

    if (isset($_GET['student_id'])) {
        $student_id = $_GET['student_id'];

        $sql = "SELECT students.mahs, students.hotenhs, subjects.*, score.*
        FROM students
        JOIN score ON students.mahs = score.student_code
        JOIN subjects ON subjects.subject_id = score.id_subject
        WHERE score.student_code = ? AND status =1";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$student_id]);
        $student_scores = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($student_scores)) {
            echo '<div class="container">';
            echo '<h1 class="mt-5">Điểm chi tiết của học sinh: ' . $student_scores[0]['hotenhs'] . '</h1>';
            echo '<table class="table table-bordered mt-3">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th>Môn</th>';
            echo '<th>Điểm kiểm tra 15 phút</th>';
            echo '<th>Điểm kiểm tra 45</th>';
            echo '<th>Điểm thi</th>';
            echo '<th>Điểm trung bình môn</th>';
            echo '<th>Action</th>';  // Added for Edit button
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($student_scores as $score) {
                echo '<tr>';
                echo '<td>' . $score['subject'] . '</td>';
                echo '<td>' . $score['diem15'] . '</td>';
                echo '<td>' . $score['diem45'] . '</td>';
                echo '<td>' . $score['thi'] . '</td>';
                echo '<td>' . $score['tbm'] . '</td>';
                echo '<td><button class="btn btn-sm btn-warning" onclick="handleEditClick(this);" data-id="' . $score['id_score'] . '">Edit</button></td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo '<p class="mt-5">No detailed scores available for this student.</p>';
        }
    } else {
        header('Location: error_page.php');
        exit();
    }
    ?>
    <script>
    
    </script>

    <!-- Edit Scores Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="update_score.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Scores</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="student_id" id="studentIDInput" value="<?= $student_id ?>">
                        <input type="hidden" name="score_id" id="scoreIdInput" value="">
                        <label for="diem15">Điểm kiểm tra 15 phút:</label>
                        <input type="text" name="diem15" id="diem15Input" class="form-control">
                        <label for="diem45">Điểm kiểm tra 45:</label>
                        <input type="text" name="diem45" id="diem45Input" class="form-control">
                        <label for="thi">Điểm thi:</label>
                        <input type="text" name="thi" id="thiInput" class="form-control">
                        <label for="tbm">Điểm trung bình môn:</label>
                        <input type="text" name="tbm" id="tbmInput" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function handleEditClick(button) {
            const scoreId = button.getAttribute('data-id');
            console.log("Captured scoreId:", scoreId);
            
            const inputElement = document.getElementById('scoreIdInput');
            inputElement.value = scoreId;
            console.log("Value of scoreIdInput:", inputElement.value);
            $('#editModal').modal('show');
        }

        function saveChangesAndGoBack() {
            alert('Changes saved!');
            window.location.href = 'teacher_site.php';
        }

    </script>

    <form method="POST" action="score_pdf.php">
        <input type="hidden" name="student_id" value="<?= $student_id ?>">
        <button type="submit" class="btn btn-primary mt-3">Export Scores to PDF</button>
    </form>

    <form method="POST" action="score_excel.php">
        <input type="hidden" name="student_id" value="<?= $student_id ?>">
        <button type="submit" class="btn btn-success mt-3">Export Scores to Excel</button>
    </form>
 
    <div class="fixed-bottom bg-light p-3 d-flex justify-content-end">
        <button type="button" class="btn btn-primary" onclick="saveChangesAndGoBack()">Save Changes and Back</button>
    </div>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
