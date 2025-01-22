<?php
require 'function.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $instansi = isset($_POST['instansi']) ? $_POST['instansi'] : '';
    $fakultas = isset($_POST['fakultas']) ? $_POST['fakultas'] : '';
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
    $rak = isset($_POST['rak']) ? $_POST['rak'] : '';

    // Check if the data already exists in the database
    $instansi_exists = mysqli_query($conn, "SELECT * FROM instansi WHERE nama_instansi = '$instansi'");
    $fakultas_exists = mysqli_query($conn, "SELECT * FROM fakultas WHERE nama_fakultas = '$fakultas'");
    $kategori_exists = mysqli_query($conn, "SELECT * FROM kategori WHERE nama_kategori = '$kategori'");
    $rak_exists = mysqli_query($conn, "SELECT * FROM rak WHERE id_rak = '$rak'");

    if (mysqli_num_rows($instansi_exists) == 0) {
        // Insert data into instansi table
        $instansi_query = "INSERT INTO instansi (nama_instansi) VALUES ('$instansi')";
        $instansi_result = mysqli_query($conn, $instansi_query);
    } else {
        $instansi_result = true;
    }

    if (mysqli_num_rows($fakultas_exists) == 0) {
        // Insert data into fakultas table
        $fakultas_query = "INSERT INTO fakultas (nama_fakultas) VALUES ('$fakultas')";
        $fakultas_result = mysqli_query($conn, $fakultas_query);
    } else {
        $fakultas_result = true;
    }

    if (mysqli_num_rows($kategori_exists) == 0) {
        // Insert data into kategori table
        $kategori_query = "INSERT INTO kategori (nama_kategori) VALUES ('$kategori')";
        $kategori_result = mysqli_query($conn, $kategori_query);
    } else {
        $kategori_result = true;
    }

    if (mysqli_num_rows($rak_exists) == 0) {
        // Insert data into rak table
        $rak_query = "INSERT INTO rak (id_rak) VALUES ('$rak')";
        $rak_result = mysqli_query($conn, $rak_query);
    } else {
        $rak_result = true;
    }

    if ($instansi_result && $fakultas_result && $kategori_result && $rak_result) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data berhasil ditambahkan!',
                    timer: 2000,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = 'depan-admin.php';
                });
            });
        </script>";
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan: " . mysqli_error($conn) . "',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        </script>";
    }
}
?>