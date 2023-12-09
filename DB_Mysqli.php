<?php

try {
    $conn = new mysqli('localhost', 'root', '', 'test7');

    // Check connection for errors
    if ($conn->connect_error) {
        throw new Exception('Failed to connect to database: ' . $conn->connect_error);
    }
} catch (Exception $e) {
    die($e->getMessage());
}
?>