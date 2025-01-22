<?php
require 'function.php';

header('Content-Type: application/json');

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $instansi = isset($_POST['instansi']) ? trim($_POST['instansi']) : '';
    $fakultas = isset($_POST['fakultas']) ? trim($_POST['fakultas']) : '';
    $kategori = isset($_POST['kategori']) ? trim($_POST['kategori']) : '';
    $rak = isset($_POST['rak']) ? trim($_POST['rak']) : '';

    $success = true;
    $errors = [];

    // Check if the data already exists in the database and insert if not empty
    if (!empty($instansi)) {
        $instansi_exists = mysqli_query($conn, "SELECT * FROM instansi WHERE nama_instansi = '$instansi'");
        if (mysqli_num_rows($instansi_exists) == 0) {
            $instansi_query = "INSERT INTO instansi (nama_instansi) VALUES ('$instansi')";
            if (!mysqli_query($conn, $instansi_query)) {
                $success = false;
                $errors[] = 'Instansi: ' . mysqli_error($conn);
            }
        }
    }

    if (!empty($fakultas)) {
        $fakultas_exists = mysqli_query($conn, "SELECT * FROM fakultas WHERE nama_fakultas = '$fakultas'");
        if (mysqli_num_rows($fakultas_exists) == 0) {
            $fakultas_query = "INSERT INTO fakultas (nama_fakultas) VALUES ('$fakultas')";
            if (!mysqli_query($conn, $fakultas_query)) {
                $success = false;
                $errors[] = 'Fakultas: ' . mysqli_error($conn);
            }
        }
    }

    if (!empty($kategori)) {
        $kategori_exists = mysqli_query($conn, "SELECT * FROM kategori WHERE nama_kategori = '$kategori'");
        if (mysqli_num_rows($kategori_exists) == 0) {
            $kategori_query = "INSERT INTO kategori (nama_kategori) VALUES ('$kategori')";
            if (!mysqli_query($conn, $kategori_query)) {
                $success = false;
                $errors[] = 'Kategori: ' . mysqli_error($conn);
            }
        }
    }

    if (!empty($rak)) {
        $rak_exists = mysqli_query($conn, "SELECT * FROM rak WHERE id_rak = '$rak'");
        if (mysqli_num_rows($rak_exists) == 0) {
            $rak_query = "INSERT INTO rak (id_rak) VALUES ('$rak')";
            if (!mysqli_query($conn, $rak_query)) {
                $success = false;
                $errors[] = 'Rak: ' . mysqli_error($conn);
            }
        }
    }

    if ($success) {
        $response['success'] = true;
        $response['message'] = 'Data berhasil ditambahkan!';
    } else {
        $response['message'] = implode(', ', $errors);
    }
}

echo json_encode($response);
?>