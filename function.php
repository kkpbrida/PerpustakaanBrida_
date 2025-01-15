
<?php
// membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "perpus_test");

if (!$conn) {
    echo "Koneksi database gagal!";
}

?>