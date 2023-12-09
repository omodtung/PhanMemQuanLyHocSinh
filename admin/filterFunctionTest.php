<?php

session_start();
include_once "../DB_connection.php";
include_once "DAL/data/teacherAd.php";
include_once "DAL/data/grade.php";
include_once "DAL/data/class.php";
include_once "DAL/data/subject.php";
include_once "BL/data/teacher.php";


// $teachers = getAllTeachers($conn);
$teachers = getAllTeachersBL($conn);




// $subjects = getAllSubjects($conn);
$subjects = getAllSubjectsBL($conn);

// $classes = getAllClass($conn);
$classes =getAllClassBL($conn);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $(document).ready(function() {
            $("#subjects").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

    </script>
b
    <style>

    </style>
</head>

<body>

    <h2>Filterable Table</h2>
    <p>Type something in the input field to search the table for first names, last names or emails:</p>
    <input id="myInput" type="text" placeholder="Search..">

 
    <div class="col-md-3">
    <label class="form-label"> Lop</label>
    <select id="subjects" class="form-select" aria-label="Default select example" name=subjects >

   
        <?php foreach ($subjects as $subject) : ?>
            <option value="<?= $subject['subject_code'] ?>"><?= $subject['subject_code'] ?></option>
        <?php endforeach ?> 

        
    </select>

  
</div>
    
   
    <br><br>

    <table class="table table-striped" id="myTable">
        <thead class="thead-dark" style="background-color:black; color:azure;">
            <tr>

                <th scope="col">Teacher ID</th>
                <th scope="col">USER NAME</th>
                <th scope="col">PASSWORD</th>
                <th scope="col">Ho Ten</th>
                <th scope="col">Ma Mon Hoc</th>
                <th scope="col"> ngay sinh</th>

                <th scope="col"> Gioi Tinh </th>
                <th scope="col"> Dia chi </th>
                <th scope="col"> Ma giao vien </th>
                <th scope="col">Ma khoi</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>

            <?php foreach ($teachers as $teacher) {

                $subjects = explode(',', trim($teacher['mamonhoc']));
                $grades = explode(',', trim($teacher['makhoi']));

                $s = '';
                foreach ($subjects as $subject) {
                    $s .= $subject . ',';
                }

                $g = '';
                foreach ($grades as $grade) {
                    $g .= $grade . ',';
                }

            ?>

                <tr>
                    <td><?= $teacher['id'] ?></td>
                    <td><?= $teacher['username'] ?></td>
                    <td><?= $teacher['password'] ?></td>
                    <td><?= $teacher['hoten'] ?></td>
                    <td><?= $s ?></td>
                    <td><?= $g ?></td>
                    <td><?= $teacher['ngaysinh'] ?></td>
                    <td><?= $teacher['gioitinh'] ?></td>
                    <td><?= $teacher['diachi'] ?></td>
                    <td><?= $teacher['magv'] ?></td>

                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalform" onclick="btnclick('./inc/editTeacher.php?idteach=<?= $teacher['id'] ?>')" data-bs-id="<?= $teacher['id'] ?>">
                            Edit
                        </button>
                        <a href="" class="btn btn-danger">Delete</a>
                        <button type="button" class="btn btn-info">Info</button>
                    </td>



                </tr>

            <?php } ?>


        </tbody>
    </table>

</body>

</html>