<?php
session_start();
require_once 'cek.php'; // Pastikan ini berisi validasi login

$pdfFile = './panduan/panduan.pdf';

if (!file_exists($pdfFile)) {
    http_response_code(404);
    die("File tidak ditemukan.");
}

if (isset($_GET['download'])) {
    // Set header agar file dikirim sebagai unduhan
    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename=panduan.pdf");
    header("Content-Length: " . filesize($pdfFile));

    readfile($pdfFile);
    exit;
}

header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=panduan.pdf");
header("Content-Length: " . filesize($pdfFile));
header("Accept-Ranges: bytes");

readfile($pdfFile);
exit;
?>
