<?php
function getAllSubjects($conn)
{

    $sql = " SELECT * From subjects";
    //chuan bi cau lenh sql
    $stmt = $conn->prepare($sql);

    //thuc  thi cau lenh sql va gan ket qua thuc thi vao bien $stmt
    $stmt->execute();
    if ($stmt->rowCount() >= 1) {
        // lay tat ca cac ket qua cua cau lenh sql thuc thi
        $subjects = $stmt->fetchAll();
        return $subjects;
    } else {
        return  0;
    }
}

//lay mon hoc theo id
function getSubjectById($subject_id, $conn)
{
    $sql = "SELECT * FROM subjects WHERE subject_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$subject_id]);
    // theo mon thi cho co 1 mon thi chi co 1 thay doi 
    if ($stmt->rowCount() == 1) {
        // $stmt=>fetch chi lay ket qua dau tien sau khi thuc hien cau lenh sql ko lay nhung cai sau

        $subject = $stmt->fetch();
        return $subject;
    } else {
        return 0;
    }
}


function getSubjectBySubject_code ($subject_code, $conn)
{
     $sql = " SELECT * FROM subjects where subject_code=?";

     $stmt = $conn->prepare($sql);
     $stmt ->execute([$subject_code]);
     if($stmt->rowCount() ==1 )
     {
        $subject = $stmt->fetch();
        return $subject;

     }else
     {
        
        return 0 ;
     }

        
    
}