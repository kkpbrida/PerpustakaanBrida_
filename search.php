<?php
require 'function.php';


$search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';
$year = isset($_POST['year']) ? $conn->real_escape_string($_POST['year']) : '';

$sql = "SELECT p.judul, p.nama_penulis, f.nama_fakultas, i.nama_instansi, p.tahun, k.nama_kategori 
        FROM penelitian p
        JOIN fakultas f ON p.id_fakultas = f.id_fakultas
        JOIN instansi i ON f.id_instansi = i.id_instantsi
        JOIN kategori k ON p.id_kategori = k.id_kategori
        WHERE 1=1";
if ($search != '') {
    $sql .= " AND (MATCH(p.judul, p.nama_penulis) AGAINST('$search' IN NATURAL LANGUAGE MODE)
                  OR f.nama_fakultas LIKE '%$search%'
                  OR i.nama_instansi LIKE '%$search%'
                  OR k.nama_kategori LIKE '%$search%')";
}
if ($year != '') {
    $sql .= " AND p.tahun = '$year'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['judul'] . "</td><td>" . $row['nama_penulis'] . "</td><td>" . $row['nama_fakultas'] . "</td><td>" . $row['nama_instansi'] . "</td><td>" . $row['tahun'] . "</td><td>" . $row['nama_kategori'] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='6'>Tidak ada hasil ditemukan</td></tr>";
}

$conn->close();
?>