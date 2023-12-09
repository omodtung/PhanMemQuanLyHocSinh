<?php
if(!empty($filterDataByCategory)) {
?>
<table border="1" cellspacing="0" cellpadding="5">
    <tr>
    

<th scope="col">student ID</th>
<th scope="col">USER Name</th>

<th scope="col"> Ma Hoc Sinh</th>
<th scope="col">Ma Khoi </th>
<th scope="col"> Ma Lop</th>

<th scope="col"> Ho Ten  Hs </th>
<th scope="col"> Ngay  Sinh </th>
<th scope="col"> Gioi Tinh</th>

<th scope="col"> Dia Chi </th>

<th scope="col"> hanh Kiem</th>
    </tr>
<?php
foreach($filterDataByCategory as $teacher){
   
?>
<tr>
    <!--  -->
    <td><?= $teacher['id'] ?></td>
                    <td><?= $teacher['username'] ?></td>
                        

                    <td><?= $teacher['mahs'] ?></td>
                    <td><?= $teacher['makhoi'] ?></td>
                    <td><?= $teacher['malop'] ?></td>
                    <td><?= $teacher['hotenhs'] ?></td>
                    <td><?= $teacher['ngaysinh'] ?></td>

                    <td><?= $teacher['gioitinh'] ?></td>
                    <td><?= $teacher['diachi'] ?></td>
                    <td><?= $teacher['hanhkiem'] ?></td>
                    
                    <td style="display: inline-flex;">
                                                <!-- <a href="teacher-edit.php?idteach=<?= $teacher['id'] ?>" class="btn btn-warning">Edit</a> -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalform" onclick="btnclick('./inc/editStudent.php?idstudent=<?= $student['id'] ?>')" data-bs-id=<?= $student['id'] ?>>
                                                    Edit
                                                </button>


                                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalinfo" onclick="btnclickinfo('./inc/StudentInfo.php?idstudent=<?= $student['id'] ?>')" data-bs-id=<?= $student['id'] ?> class="btn btn-info">Info</button>
                                                <a href="BL/deletestudent.php?id=<?= $student['id'] ?>" class="btn btn-danger">Delete</a>





                                            </td>

</tr>
<?php
 }
?>

</table>
<?php
}

?>