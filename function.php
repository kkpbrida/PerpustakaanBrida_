<?php
session_start();
// membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_perpustakaan");

if (!$conn) {
    echo "Koneksi database gagal!";
}

// tambah penelitian
if(isset($_POST['addpenelitian'])) {
    $tgl_masuk = $_POST['tgl_masuk'];
    $instansi = $_POST['instansi'];
    $fakultas = $_POST['fakultas'];
    $kategori = $_POST['kategori'];
    $judul = $_POST['judul'];
    $tahun = $_POST['tahun'];
    $rak = $_POST['rak'];

    // Concatenate all author names into a single string separated by commas
    $nama_penulis = implode(", ", $_POST['nama_penulis']);

    $addtotable = mysqli_query($conn, "INSERT INTO penelitian (tgl_masuk, nama_penulis, id_kategori, judul, tahun, id_rak, id_instansi, id_fakultas) 
    VALUES ('$tgl_masuk', '$nama_penulis', '$kategori', '$judul', '$tahun', '$rak', '$instansi', '$fakultas')");

    if ($addtotable) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            });
        </script>";
    } else {
        die("Error: " . mysqli_error($conn));
    }
}
?>

<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Data penelitian berhasil ditambahkan!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
