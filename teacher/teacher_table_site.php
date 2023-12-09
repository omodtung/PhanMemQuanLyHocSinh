<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Info</title>
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
        <label class="h4">Select teacher information:</label>
        <select name="selected_teacher_grade" onchange="this.form.submit()" class="form-control">
            <option value="" disabled selected>Select a teacher</option>
            <option value="1">Khối 10</option>
            <option value="2">Khối 11</option>
            <option value="3">Khối 12</option>
        
        </select>
    </form>

    <?php
    include "../DB_connection.php";
    if (isset($_POST["selected_teacher_grade"])) {
        $selected_teacher_grade = $_POST["selected_teacher_grade"];
        $query = "SELECT * FROM teachers WHERE makhoi = :selected_teacher_grade";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':selected_teacher_grade', $selected_teacher_grade, PDO::PARAM_STR);
        $stmt->execute();
        $name_teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    if (isset($_POST["selected_teacher_grade"])) {
        $selected_teacher_grade = $_POST["selected_teacher_grade"];
        $query = "SELECT magv, hoten, mamonhoc, makhoi, ngaysinh, gioitinh, diachi FROM teachers WHERE makhoi = :selected_teacher_grade";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':selected_teacher_grade', $selected_teacher_grade, PDO::PARAM_STR);
        $stmt->execute();
        $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (!empty($teachers)) {
            echo '<table class="table table-bordered mt-3">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Mã Giáo Viên</th>';
            echo '<th>Tên Giáo Viên</th>';
            echo '<th>Mã môn học </th>';
            echo '<th>Mã khối</th>';
            echo '<th>Ngày sinh</th>';
            echo '<th>Giới Tính</th>';
            echo '<th>Địa Chỉ</th>';

            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($teachers as $teacher) {
                echo '<tr>';
                echo '<td>' . $teacher['magv'] . '</td>';
                echo '<td>' . $teacher['hoten'] . '</td>';
                echo '<td>' . $teacher['mamonhoc'] . '</td>';
                echo '<td>' . $teacher['makhoi'] . '</td>';
                echo '<td>' . $teacher['ngaysinh'] . '</td>';
                echo '<td>' . $teacher['gioitinh'] . '</td>';
                echo '<td>' . $teacher['diachi'] . '</td>';

                echo '<td>';
                echo '<button type="button" onclick="window.location.href=\'TeacherInfo.php?teacher_info=' . $teacher['magv'] . '\'">';
                echo 'View More';
                echo '</button>';
                echo '</td>';
                
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No teachers available for the selected grade.</p>';
        }
    }
    ?>


    <!-- Include Bootstrap JS (Optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
