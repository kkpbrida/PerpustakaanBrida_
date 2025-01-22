<?php
require 'function.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $type = $_POST['type'];

    if ($type == 'instansi') {
        $query = "DELETE FROM instansi WHERE id_instansi = $id";
    } elseif ($type == 'fakultas') {
        $query = "DELETE FROM fakultas WHERE id_fakultas = $id";
    } elseif ($type == 'kategori') {
        $query = "DELETE FROM kategori WHERE id_kategori = $id";
    } elseif ($type == 'rak') {
        $query = "DELETE FROM rak WHERE id_rak = '$id'";
    }

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan: ' . mysqli_error($conn)]);
    }
}
?>