<?php
if(!empty($filterDataByCategory)) {
?>
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
    

<th scope="col">Teacher ID</th>
<th scope="col">USER NAME</th>

<th scope="col">Ho Ten</th>
<th scope="col">Ma Mon Hoc</th>
<th scope="col"> ngay sinh</th>

<th scope="col"> Gioi Tinh </th>
<th scope="col"> Dia chi </th>
<th scope="col"> Ma giao vien </th>

<th scope="col"> Action </th>


    </tr>
<?php
foreach($filterDataByCategory as $teacher){
   
?>
<tr>
    <!--  -->
    <td><?= $teacher['id'] ?></td>
                    <td><?= $teacher['username'] ?></td>
                  
                    <td><?= $teacher['hoten'] ?></td>
                    

                    <td><?= $teacher['mamonhoc'] ?></td>
                    <td><?= $teacher['ngaysinh'] ?></td>
                    <td><?= $teacher['gioitinh'] ?></td>
                    <td><?= $teacher['diachi'] ?></td>
                    <td><?= $teacher['magv'] ?></td>
                    <td style="display: inline-flex;">
                                                <!-- <a href="teacher-edit.php?idteach=<?= $teacher['id'] ?>" class="btn btn-warning">Edit</a> -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalform" onclick="btnclick('./inc/editTeacher.php?idteach=<?= $teacher['id'] ?>')" data-bs-id=<?= $teacher['id'] ?>>
                                                    Edit
                                                </button>


                                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalinfo" onclick="btnclickinfo('./inc/TeacherInfo.php?idteach=<?= $teacher['id'] ?>')" data-bs-id=<?= $teacher['id'] ?> class="btn btn-info">Info</button>
                                                <a href="./BL/deleteteacher.php?id=<?=$teacher['id'] ?>" class="btn btn-danger">Delete</a>






                                            </td>

</tr>
<?php
 }
?>

</table>
<?php
}

?>