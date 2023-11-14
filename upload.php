<?php
require 'includes/database.php';
$conn = getDB();


$uploadDir = 'uploads/';

if (!isset($_FILES['pdf'])) {
    die('PDF file not found');
}

$file = $_FILES['pdf'];

// Generate a unique file name to avoid conflicts
$fileName = pathinfo($file['name'], PATHINFO_FILENAME) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
$filePath = $uploadDir . $fileName;

if (move_uploaded_file($file['tmp_name'], $filePath)) {
    echo $fileName; // Return the generated file name
} else {
    http_response_code(500);
    echo 'Failed to upload PDF file';
}

