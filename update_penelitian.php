<?php
require 'function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id_penelitian']) ? $conn->real_escape_string($_POST['id_penelitian']) : '';
    $judul = isset($_POST['judul']) ? $conn->real_escape_string($_POST['judul']) : '';
    $nama_penulis = isset($_POST['nama_penulis']) ? $conn->real_escape_string($_POST['nama_penulis']) : '';

    // Tambahkan field lain sesuai kebutuhan

    if ($id && $judul && $nama_penulis) {
        $sql = "UPDATE penelitian SET judul = '$judul', nama_penulis = '$nama_penulis' WHERE id_penelitian = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Data updated successfully";
        } else {
            echo "Error updating data: " . $conn->error;
        }
    } else {
        echo "Invalid input";
    }

    $conn->close();
} else {
    echo "Invalid request method";
}
?>