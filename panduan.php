<?php
session_start();
require 'cek.php';
// File path to the PDF
$pdfFile = 'panduan.pdf';

// Check if the file exists
if (file_exists($pdfFile)) {
    // Set headers to open the PDF file
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="' . $pdfFile . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');

    // Read the file and send it to the output buffer
    @readfile($pdfFile);
} else {
    echo "File not found.";
}
?>