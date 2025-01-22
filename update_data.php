<?php
require 'function.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $tahun = $_POST['tahun'];
    $type = isset($_POST['type']) ? $_POST['type'] : '';

    // Log the received data
    error_log("Received data - ID: $id, Nama: $nama, Type: $type");

    if (empty($type)) {
        error_log("Type is empty");
        echo json_encode(['success' => false, 'message' => 'Type is empty']);
        exit;
    }

    if ($type == 'instansi') {
        $query = "UPDATE instansi SET nama_instansi = '$nama' WHERE id_instansi = $id";
    } elseif ($type == 'fakultas') {
        $query = "UPDATE fakultas SET nama_fakultas = '$nama' WHERE id_fakultas = $id";
    } elseif ($type == 'kategori') {
        $query = "UPDATE kategori SET nama_kategori = '$nama' WHERE id_kategori = $id";
    } elseif ($type == 'rak') {
        $query = "UPDATE rak SET id_rak = '$nama' WHERE id_rak = '$id'";
    } else {
        error_log("Invalid type: " . $type);
        echo json_encode(['success' => false, 'message' => 'Invalid type']);
        exit;
    }

    // Log the query
    error_log("Executing query: " . $query);
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Data berhasil diperbarui!']);
    } else {
        error_log("MySQL error: " . mysqli_error($conn)); // Log the error
        echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>