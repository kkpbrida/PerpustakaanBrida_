<?php
// session_start();
// // membuat koneksi ke database
// $conn = mysqli_connect("localhost", "root", "", "db_perpustakaan");

// if (!$conn) {
//     echo "Koneksi database gagal!";
// }

// // tambah penelitian
// if(isset($_POST['addpenelitian'])) {
//     $tanggal_registrasi = $_POST['tanggal_registrasi'];
//     $instansi = $_POST['instansi'];
//     $fakultas = $_POST['fakultas'];
//     $kategori = $_POST['kategori'];
//     $judul = $_POST['judul'];
//     $tahun = $_POST['tahun'];
//     $rak = $_POST['rak'];

//     foreach ($_POST['nama_penulis'] as $penulis) {
//         $addtotable = mysqli_query($conn, "INSERT INTO penelitian (tanggal_registrasi, nama_penulis, instansi, fakultas, kategori, judul, tahun, rak) 
//         VALUES ('$tanggal_registrasi', '$penulis', '$instansi', '$fakultas', '$kategori', '$judul', '$tahun', '$rak')");
//     }
//     if($addtotable) {
//         echo "<script>
//             alert('Data penelitian berhasil ditambahkan!');
//             window.location.href='index.php';
//         </script>";
//     } else {
//         echo "<script>
//             alert('Data penelitian gagal ditambahkan!');
//             window.location.href='form.php';
//         </script>";
//     }

// }
?> 

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
    // $instansi = $_POST['instansi'];
    $fakultas = $_POST['fakultas'];
    $kategori = $_POST['kategori'];
    $judul = $_POST['judul'];
    $tahun = $_POST['tahun'];
    $rak = $_POST['rak'];

    foreach ($_POST['nama_penulis'] as $nama_penulis) {
        $addtotable = mysqli_query($conn, "INSERT INTO penelitian (tgl_masuk, nama_penulis, id_fakultas, id_kategori, judul, tahun, id_rak) 
        VALUES ('$tgl_masuk', '$nama_penulis', '$fakultas', '$kategori', '$judul', '$tahun', '$rak')");

        if (!$addtotable) {
            die("Error: " . mysqli_error($conn));
        }
    }
    echo "<script>
        alert('Data penelitian berhasil ditambahkan!');
        window.location.href='index.php';
    </script>";
}
?> 