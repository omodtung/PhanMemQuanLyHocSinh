<?php

// Close any existing database connections
$pdo = null;

// Try to connect to the database
try {
    $pdo = new PDO("mysql:host=localhost;dbname=test7", "root", "");
} catch (PDOException $e) {
    echo "Error connecting to the database: " . $e->getMessage();
    exit;
}
if(isset($_GET["student"])) {
    echo '<a href="./DAL/export.php?studentsearched=' . $_POST['input'] . '" class="btn btn-outline-primary ">Export Search Result</a>';
    try {
        $input = $_POST['input'];
        $query = "SELECT * FROM students JOIN avgscore ON students.id=avgscore.student_id WHERE hotenhs LIKE '{$input}%' AND status = 1";
        $rows = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    
        // If there are any results, display them in a table
        if (count($rows) > 0) {
            echo '<table class="table table-striped" id="searchresult">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">Student ID</th>';
            echo '<th scope="col">User Name</th>';
            echo '<th scope="col">Ho Ten</th>';
            echo '<th scope="col">Hanh Kiem</th>';
            echo '<th scope="col">Hoc Luc</th>';
            echo '<th scope="col">Ngay Sinh</th>';
            echo '<th scope="col">Gioi Tinh</th>';
            echo '<th scope="col">Dia Chi</th>';
            echo '<th scope="col">Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
    
            foreach ($rows as $row) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['hotenhs'] . '</td>';
                echo '<td>' . $row['hanhkiem'] . '</td>';
                echo '<td>' . $row['HocLuc'] . '</td>';
                echo '<td>' . $row['ngaysinh'] . '</td>';
                echo '<td>' . $row['gioitinh'] . '</td>';
                echo '<td>' . $row['diachi'] . '</td>';
                
                echo '<td>';
                echo '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalform" onclick="btnclick("./inc/editStudent.php?idstudent='. $row["id"] .'")" data-bs-id='. $row["id"] .'>
                Edit
            </button>';
                echo '<button type="button" data-bs-toggle="modal" data-bs-target="#modalinfo" onclick="btnclickinfo(`./inc/StudentInfo.php?idstudent='. $row["id"] .'`)" data-bs-id='. $row["id"] .' class="btn btn-info">Info</button>';
                echo '<a href="BL/deletestudent.php?id='. $row["id"] .'" class="btn btn-danger">Delete</a>';
                echo '</td>';
                echo '</tr>';
            }
    
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<h3>No students found.</h3>';
        }
    } catch (PDOException $e) {
        echo "Error executing the query: " . $e->getMessage();
    }
}
else if(isset($_GET["schedule"])) {
    echo '<a href="./DAL/export.php?schedulesearched=' . $_POST['input'] . '" class="btn btn-outline-primary ">Export Search Result</a>';
    try {
        $input = $_POST['input'];
        $query = "SELECT * FROM schedule WHERE HoTen LIKE '{$input}%'";
        $rows = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    
        // If there are any results, display them in a table
        if (count($rows) > 0) {
            echo '<table class="table table-striped" id="searchresult">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">Schedule ID</th>';
            echo '<th scope="col">Teacher ID</th>';
            echo '<th scope="col">Ho Ten</th>';
            echo '<th scope="col">Start Time</th>';
            echo '<th scope="col">End Time</th>';
            echo '<th scope="col">Work Date</th>';
            echo '<th scope="col">Class</th>';
            echo '<th scope="col">Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
    
            foreach ($rows as $row) {
                echo '<tr>';
                echo '<td>' . $row['ID_Schedule'] . '</td>';
                echo '<td>' . $row['TeacherId'] . '</td>';
                echo '<td>' . $row['HoTen'] . '</td>';
                echo '<td>' . $row['StartTime'] . '</td>';
                echo '<td>' . $row['EndTime'] . '</td>';
                echo '<td>' . $row['WorkDate'] . '</td>';
                echo '<td>' . $row['Class'] . '</td>';
                
                
                echo '<td>';
                // echo '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalform" onclick="btnclick(`./inc/editSchedule.php?id=' . $row["ID_Schedule"] . '`)" data-bs-id='. $row["ID_Schedule"] .'> Edit </button>';
                // echo '<a href="BL/deleteschedule.php?id=' . $row['ID_Schedule'] .'" class="btn btn-danger">Delete</a>';
                // echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalforminfo" onclick="btnclickinfo(`./inc/ScheduleInfo.php?id='. $row["TeacherId"] .'`)" data-bs-id='. $row["TeacherId"] .'>Detail </button>';
               echo '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalform" onclick="btnclick(`./inc/editSchedule.php?id=' . $row["ID_Schedule"] . '`)" data-bs-id='. $row["ID_Schedule"] .'> Edit </button>';
                echo '<a href="BL/deleteschedule.php?id=' . $row['ID_Schedule'] .'" class="btn btn-danger">Delete</a>';
                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalforminfo" onclick="btnclickinfo(`./inc/ScheduleInfo.php?id='. $row["TeacherId"] .'`)" data-bs-id='. $row["TeacherId"] .'>Detail </button>';
             
                echo '</td>';
                echo '</tr>';
            }
    
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<h3>No schedules found.</h3>';
        }
    } catch (PDOException $e) {
        echo "Error executing the query: " . $e->getMessage();
    }
}
else if(isset($_GET["timetable"])) {
    echo '<a href="./DAL/export.php?timetablesearched=' . $_POST['input'] . '" class="btn btn-outline-primary ">Export Search Result</a>';
    try {
        $input = $_POST['input'];
        $query = "SELECT * FROM students JOIN (SELECT * FROM schedule GROUP BY Class) as sche on sche.Class = students.malop WHERE hotenhs LIKE '{$input}%'";
        $rows = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    
        // If there are any results, display them in a table
        if (count($rows) > 0) {
            echo '<table class="table table-striped" id="searchresult">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">Ma</th>';
            echo '<th scope="col">Ho Ten</th>';
            echo '<th scope="col">Lop</th>';
            echo '<th scope="col">Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
    
            foreach ($rows as $row) {
                echo '<tr>';
                echo '<td>' . $row['mahs'] . '</td>';
                echo '<td>' . $row['hotenhs'] . '</td>';
                echo '<td>' . $row['malop'] . '</td>';
                
                
                echo '<td>';
                // echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalforminfo" onclick="btnclickinfo(`./inc/TimeTableinfo.php?id='. $row["malop"] .'`)" data-bs-id='. $row["malop"] .'>Detail </button>';

                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalforminfo" onclick="btnclickinfo(`./inc/TimeTableinfo.php?id='. $row["malop"] .'`)" data-bs-id='. $row["malop"] .'>Detail </button>';
                echo '</td>';
                echo '</tr>';
            }
    
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<h3>No Time Tables found.</h3>';
        }
    } catch (PDOException $e) {
        echo "Error executing the query: " . $e->getMessage();
    }
}
else {echo '<a href="./DAL/export.php?searched=' . $_POST['input'] . '" class="btn btn-outline-primary ">Export Search Result</a>';

// Try to execute the query
try {
    $input = $_POST['input'];
    $query = "SELECT * FROM teachers WHERE hoten LIKE '{$input}%' AND status =1";
    $rows = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);

    // If there are any results, display them in a table
    if (count($rows) > 0) {
        echo '<table class="table table-striped" id="searchresult">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Teacher ID</th>';
        echo '<th scope="col">User Name</th>';
        echo '<th scope="col">Ho Ten</th>';
        echo '<th scope="col">Ma Mon Hoc</th>';
        echo '<th scope="col">Ngay Sinh</th>';
        echo '<th scope="col">Gioi Tinh</th>';
        echo '<th scope="col">Dia Chi</th>';
        echo '<th scope="col">Ma Giao Vien</th>';
        echo '<th scope="col">Ma Khoi</th>';

        echo '<th scope="col">Trang Thai</th>';
        echo '<th scope="col">Action</th>';
        
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($rows as $row) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['hoten'] . '</td>';
            echo '<td>' . $row['mamonhoc'] . '</td>';
            echo '<td>' . $row['ngaysinh'] . '</td>';
            echo '<td>' . $row['gioitinh'] . '</td>';
            echo '<td>' . $row['diachi'] . '</td>';
          
            echo '<td>' . $row['magv'] . '</td>';
            echo '<td>' . $row['makhoi'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo '<td>';
            echo '<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalform" onclick="btnclick(`./inc/editTeacher.php?idteach='.  $row["id"] .'`)" data-bs-id='. $row["id"] .'>
            Edit
        </button>';
            echo '<button type="button" data-bs-toggle="modal" data-bs-target="#modalinfo" onclick="btnclickinfo(`./inc/TeacherInfo.php?idteach='. $row['id'] .'`)" data-bs-id='.$row['id'] .' class="btn btn-info">Info</button>';
            echo '<a href="BL/deleteteacher.php?id='. $row["id"] .'" class="btn btn-danger">Delete</a>';
         //   echo '<a href="BL/deletestudent.php?id='. $row["id"] .'" class="btn btn-danger">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<h3>No teachers found.</h3>';
    }
} catch (PDOException $e) {
    echo "Error executing the query: " . $e->getMessage();
}
}
// Close the database connection
$pdo = null;

?>
