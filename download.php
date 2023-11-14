<?php

if (!isset($_GET['pdf'])) {
    // die('PDF file not found');
    echo '<script>alert("PDF bulunamadı"); window.history.back();</script>';
    exit();
}

$pdfPath = $_GET['pdf'];

if (!file_exists($pdfPath)) {
    // die('PDF file not found');
    echo '<script>alert("PDF bulunamadı"); window.history.back();</script>';
    exit();
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($pdfPath) . '"');
header('Content-Length: ' . filesize($pdfPath));

readfile($pdfPath);
exit();
