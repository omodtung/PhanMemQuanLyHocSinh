<?php
include "../DB_connection.php"; // Ensure this path is correct

if (isset($_GET['teacher_id'])) {
    $teacher_id = $_GET['teacher_id'];

    $sql = "SELECT image FROM schema5.teachers WHERE magv = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$teacher_id]);
    $stmt->bindColumn(1, $image, PDO::PARAM_LOB);
    $stmt->fetch(PDO::FETCH_BOUND);

    if($image) {
        header("Content-Type: image/jpeg"); // Change 'image/jpeg' to the correct content type of your image (e.g., image/png)
        echo $image;
    } else {
        // You can provide a default image path if the teacher has no image
        $defaultImagePath = 'path_to_default_image.jpg';
        header("Content-Type: image/jpeg");
        echo file_get_contents($defaultImagePath);
    }
}
?>
