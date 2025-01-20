<?php
require 'function.php';

// hapus data
$id = $_POST['id'];
$sql = "DELETE FROM penelitian WHERE id_penelitian = '$id'";
if (mysqli_query($conn, $sql)) {
    echo "Data berhasil dihapus";
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}

// Periksa apakah data masih ada di database
$query = "SELECT * FROM penelitian WHERE id_penelitian = '$id'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    echo "Data masih ada di database";
} else {
    echo "Data berhasil dihapus";
}

mysqli_close($conn);
?>