<?php
require 'function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id_penelitian']) ? $conn->real_escape_string($_POST['id_penelitian']) : '';
    $judul = isset($_POST['judul']) ? $conn->real_escape_string($_POST['judul']) : '';
    $tgl_masuk = isset($_POST['tgl_masuk']) ? $conn->real_escape_string($_POST['tgl_masuk']) : '';
    $instansi = isset($_POST['instansi']) ? $conn->real_escape_string($_POST['instansi']) : '';
    $fakultas = isset($_POST['fakultas']) ? $conn->real_escape_string($_POST['fakultas']) : '';
    $kategori = isset($_POST['kategori']) ? $conn->real_escape_string($_POST['kategori']) : '';
    $tahun = isset($_POST['tahun']) ? $conn->real_escape_string($_POST['tahun']) : '';
    $rak = isset($_POST['rak']) ? $conn->real_escape_string($_POST['rak']) : '';
    $nama_penulis = isset($_POST['nama_penulis']) ? implode(", ", array_map([$conn, 'real_escape_string'], $_POST['nama_penulis'])) : '';

    if ($id && $judul && $nama_penulis && $tgl_masuk && $instansi && $fakultas && $kategori && $tahun && $rak) {
        $sql = "UPDATE penelitian SET judul = '$judul', nama_penulis = '$nama_penulis', tgl_masuk = '$tgl_masuk', id_instansi = '$instansi', id_fakultas = '$fakultas', id_kategori = '$kategori', tahun = '$tahun', id_rak = '$rak' WHERE id_penelitian = '$id'";
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