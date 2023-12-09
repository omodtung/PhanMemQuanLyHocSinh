<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Student') {
        include "../DB_connection.php";
        
        // Nhận id_student từ form
        $id = $_POST['id_student_hide'];
        echo $id;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
            $targetDirectory = "../admin/uploads/";

            // Đổi tên file thành chuỗi bằng cách thêm dấu . và chuỗi hậu tố ngẫu nhiên
            $randomSuffix = uniqid();
            $originalFileName = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_FILENAME);
            $newFileName = $originalFileName . '_' . $randomSuffix;

            $targetFile = $targetDirectory . $newFileName . "." . strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
            $uploadOk = 1;

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check === false) {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if (file_exists($targetFile)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            $allowedFormats = array("jpg", "jpeg", "png", "gif");
            if (!in_array(strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)), $allowedFormats)) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } 
            else {

            // Kiểm tra xem id_student đã tồn tại trong bảng images chưa
            $checkSql = "SELECT * FROM images WHERE id_student = :id_student";
            $checkStatement = $conn->prepare($checkSql);
            $checkStatement->bindParam(':id_student', $id);
            $checkStatement->execute();
            $existingImage = $checkStatement->fetch();

            if ($existingImage) {
                // Nếu đã tồn tại, cập nhật đường dẫn ảnh mới
                $updateSql = "UPDATE images SET image_path = :image_path WHERE id_student = :id_student";
                $updateStatement = $conn->prepare($updateSql);
                $updateStatement->bindParam(':id_student', $id);
                $updateStatement->bindParam(':image_path', $targetFile);
                $updateStatement->execute();
            } else {
                // Nếu chưa tồn tại, thêm một bản ghi mới vào cơ sở dữ liệu
                $insertSql = "INSERT INTO images (id_student, image_path) VALUES (:id_student, :image_path)";
                $insertStatement = $conn->prepare($insertSql);
                $insertStatement->bindParam(':id_student', $id);
                $insertStatement->bindParam(':image_path', $targetFile);
                $insertStatement->execute();
            }

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded and saved to the database.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
 } else {
        header("Location: ../login.php");
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>
            