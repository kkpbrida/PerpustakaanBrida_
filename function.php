<?php
session_start();
// membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_perpustakaan");

if (!$conn) {
    echo "Koneksi database gagal!";
}

?>