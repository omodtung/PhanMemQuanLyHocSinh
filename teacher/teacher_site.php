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
            background-color: #f7f8fc;
            font-family: 'Nunito', sans-serif;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #f9748f;
        }

        .navbar-brand {
            color: white !important;
        }

        /* Button Styles */
        button {
            background-color: #86cbfd;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            box-shadow: 0 4px 15px -5px #f9748f;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.2s;
        }

        button:hover {
            transform: scale(1.05);
            background-color: #0000FF;
        }

        /* Table Styles */
        table {
            margin-top: 20px;
        }

        /* Footer Styles */
        footer {
            background-color: #f9748f;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        
        /* Styles for select dropdowns */
        select.form-control {
            padding: 18px 50px 18px 25px; /* Increased padding */
            font-size: 18px; /* Larger font size */
            border-radius: 25px; 
            border: 1px solid #e0e0e0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            appearance: none; /* Remove default appearance */
            background-color: #fff;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 15px center;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        select.form-control:hover {
            border-color: #f9748f;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        select.form-control:focus {
            border-color: #fd868c;
            box-shadow: 0 0 0 0.25rem rgba(249, 116, 143, 0.5);
            outline: none;
        }

        label.h4 {
            margin-bottom: 15px; /* Add spacing below the label */
        }


        .btn-logout {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #86cbfd; /* or any color you prefer */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            box-shadow: 0 4px 15px -5px #0000FF; /* same as other buttons for consistency */
            font-weight: bold;
            cursor: pointer;
        }

        .btn-logout:hover {
            background-color: #fd868c; /* a slightly different color on hover */
        }
        
        .navbar-nav .nav-link {
            font-size: 20px; /* Increase the font size */
            font-weight: bold; /* Optional: makes the text bold */
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #444444;">
        <!-- Replace 'School Portal' text with an image -->
        <a class="navbar-brand" href="teacher_site.php">
            <img src="../sgu-logo.png" alt="Logo" style="height: 50px;"> <!-- Adjust the path and size as needed -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="teacher_site.php">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="teacher_table_site.php">Teachers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="change_password.php">Change Password</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <button type="button" onclick="window.location.href='../login.php'" class="btn-logout">Log Out</button>
                </li>
            </ul>
        </div>
    </nav>


    <form method="POST" action="">
        <!-- Larger "Select Grade" text using Bootstrap classes -->
        <label class="h4">Select Grade:</label>
        <select name="selected_grade" onchange="this.form.submit()" class="form-control">
            <option value="" disabled selected>Select a grade</option>
            <option value="k10">Khối 10</option>
            <option value="k11">Khối 11</option>
            <option value="k12">Khối 12</option>
        </select>
    </form>
    <?php
        include "../DB_connection.php";
        if (isset($_POST["selected_grade"])) {
            // Handle the selected grade and fetch student scores here
            $selected_grade = $_POST["selected_grade"];
            // Replace the following lines with your database query and results retrieval
            $student_scores = []; // Sample data
        
            // Your SQL query to filter by selected grade
            $sql = "SELECT students.mahs, students.hotenhs, AVG(score.tbm) AS diem_tb
                    FROM test7.score
                    JOIN test7.students ON score.student_code = students.mahs
                    WHERE students.makhoi = :selected_grade AND status =1
                    GROUP BY students.mahs, students.hotenhs
                    ";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':selected_grade', $selected_grade, PDO::PARAM_STR);
            $stmt->execute();
            $student_scores = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($student_scores)) {
                echo '<table class="table table-bordered mt-3">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Mã Học Sinh</th>';
                echo '<th>Họ Tên Học Sinh</th>';
                echo '<th>Điểm Trung Bình Học Kì</th>';
                echo '<th>Xem chi tiết</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($student_scores as $score) {
                    echo '<tr>';
                    echo '<td>' . $score['mahs'] . '</td>';
                    echo '<td>' . $score['hotenhs'] . '</td>';
                    echo '<td>' . number_format($score['diem_tb'], 2) . '</td>';
                
                    echo '<td>';
                    echo '<button type="button" onclick="window.location.href=\'Score_student.php?student_id=' . $score['mahs'] . '\'">View More</button>';
                    echo '&nbsp;'; 
                    echo '<button type="button" onclick="deleteRequest(event, \'' . $score['mahs'] . '\')">DeleteRequest</button>';
                    echo '</td>';

                    
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>No student scores available for the selected grade.</p>';
            }
        }
    ?>

    <!-- Include Bootstrap JavaScript (Optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function toggleScores(link) {
            var scoresDiv = link.nextElementSibling;
            if (scoresDiv.style.display === 'none') {
                scoresDiv.style.display = 'block';
                link.innerHTML = 'Hide Scores';
            } else {
                scoresDiv.style.display = 'none';
                link.innerHTML = 'View More';
            }
        }
    

        function deleteRequest(event, studentId) {
            event.preventDefault();  // Prevent the default behavior (form submission/redirect)

            // if (confirm('Thầy/Cô muốn đề xuất xóa học sinh này?')) {
                // Send AJAX request to a PHP script to handle the database update
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'handle_delete_request.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status == 200 && this.responseText == 'success') {
                        alert('Yêu cầu xóa học sinh đã được gửi.');
                    } else {
                        alert('Không thể gửi yêu cầu xóa học sinh.');
                    }
                };
                xhr.send('student_id=' + studentId);
            // }
        }

    </script>


    <form action="upload_scores.php" method="post" enctype="multipart/form-data">
        Chọn excel file điểm học sinh:
        <input type="file" name="studentScoresFile" id="studentScoresFile">
        <button type="button" name="submit" onclick="uploadFile()">Upload</button>
    </form>
    
    <script>
        function uploadFile() {
            var fileInput = document.getElementById('studentScoresFile');
            var file = fileInput.files[0];
            if (!file) {
                alert('Please select a file first.');
                return;
            }

            var formData = new FormData();
            formData.append('studentScoresFile', file);
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'upload_scores.php', true);
            
            xhr.onload = function() {
                if (this.status == 200) {
                    if (this.responseText.trim() == 'success') {
                        alert('File uploaded successfully!');
                        window.location.reload()
                    } else {
                        alert('File uploaded successfully!');
                        window.location.reload()
                    }
                }
            };
            
            xhr.send(formData);
        }
    </script>

    <!-- <button type="button" onclick="window.location.href='../login.php'" class="btn-logout">Log Out</button> -->


</body>
</html>
