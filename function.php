<?php
session_start();
// membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "perpustakaandb");

if (!$conn) {
    echo "Koneksi database gagal!";
}

?>