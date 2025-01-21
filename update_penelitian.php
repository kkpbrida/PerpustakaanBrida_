<?php
require 'function.php';

// Prevent any output before JSON response
ob_clean();
header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    // Validasi input
    if (empty($_POST['id_penelitian']) || empty($_POST['judul']) || 
        empty($_POST['nama_penulis']) || empty($_POST['tgl_masuk']) || 
        empty($_POST['instansi']) || empty($_POST['fakultas']) || 
        empty($_POST['kategori']) || empty($_POST['tahun']) || 
        empty($_POST['rak'])) {
        throw new Exception('Semua field harus diisi');
    }

    // Escape input
    $id = $conn->real_escape_string($_POST['id_penelitian']);
    $judul = $conn->real_escape_string($_POST['judul']);
    $tgl_masuk = $conn->real_escape_string($_POST['tgl_masuk']);
    $instansi = $conn->real_escape_string($_POST['instansi']);
    $fakultas = $conn->real_escape_string($_POST['fakultas']);
    $kategori = $conn->real_escape_string($_POST['kategori']);
    $tahun = $conn->real_escape_string($_POST['tahun']);
    $rak = $conn->real_escape_string($_POST['rak']);
    
    // Handle nama_penulis array
    $nama_penulis = is_array($_POST['nama_penulis']) 
        ? implode(", ", array_map([$conn, 'real_escape_string'], $_POST['nama_penulis']))
        : $conn->real_escape_string($_POST['nama_penulis']);

    $sql = "UPDATE penelitian SET 
            judul = '$judul', 
            nama_penulis = '$nama_penulis', 
            tgl_masuk = '$tgl_masuk', 
            id_instansi = '$instansi', 
            id_fakultas = '$fakultas', 
            id_kategori = '$kategori', 
            tahun = '$tahun', 
            id_rak = '$rak' 
            WHERE id_penelitian = '$id'";

    if (!$conn->query($sql)) {
        throw new Exception($conn->error);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Data penelitian berhasil diperbarui'
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

// Pastikan tidak ada output lain setelah JSON
exit;
?>