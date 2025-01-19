<?php
// Aktifkan pelaporan error
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Tangkap output buffer untuk memastikan tidak ada output lain
ob_start();

require 'function.php';

// Pastikan tidak ada output lain sebelum ini
header('Content-Type: application/json');

$search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';
$year = isset($_POST['year']) ? $conn->real_escape_string($_POST['year']) : '';
$category = isset($_POST['category']) ? $conn->real_escape_string($_POST['category']) : '';
$instansi = isset($_POST['instansi']) ? $conn->real_escape_string($_POST['instansi']) : '';
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = 10; // Jumlah record per halaman
$offset = ($page - 1) * $limit;

// Tentukan kolom yang akan ditampilkan berdasarkan halaman yang memanggil
$columns = "p.id_penelitian, p.judul, p.nama_penulis, i.nama_instansi, f.nama_fakultas, p.tahun, k.nama_kategori, p.id_rak";
if (isset($_POST['page_type']) && $_POST['page_type'] == 'index') {
    $columns .= ", p.tgl_masuk";
}

$sql = "SELECT $columns
        FROM penelitian p
        JOIN instansi i ON p.id_instansi = i.id_instansi
        JOIN kategori k ON p.id_kategori = k.id_kategori
        JOIN fakultas f ON p.id_fakultas = f.id_fakultas";
$sql .= " WHERE 1=1";
if ($search != '') {
    $sql .= " AND (p.judul LIKE '%$search%' OR p.nama_penulis LIKE '%$search%' OR i.nama_instansi LIKE '%$search%')";
}
if ($year != '') {
    $sql .= " AND p.tahun = '$year'";
}
if ($category != '') {
    $sql .= " AND k.nama_kategori = '$category'";
}
if ($instansi != '') {
    $sql .= " AND i.nama_instansi = '$instansi'";
}

$total_sql = "SELECT COUNT(*) as total FROM ($sql) as subquery";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

$sql .= " LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$data = '';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data .= "<tr><td>" . $row['judul'] . "</td><td>" . $row['nama_penulis'] . "</td><td>" . $row['nama_fakultas'] . "</td><td>" . $row['nama_instansi'] . "</td><td>" . $row['tahun'] . "</td><td>" . $row['nama_kategori'] . "</td><td>" . $row['id_rak'] . "</td>";
        if (isset($_POST['page_type']) && $_POST['page_type'] == 'index') {
            $data .= "<td>" . $row['tgl_masuk'] . "</td>";
            $data .= "<td><button type='button' class='btn btn-primary btn-edit' 
                        data-id='" . $row['id_penelitian'] . "' 
                        data-tgl_masuk='" . $row['tgl_masuk'] . "'
                        data-judul='" . $row['judul'] . "'
                        data-nama_penulis='" . $row['nama_penulis'] . "'
                        data-instansi='" . $row['nama_instansi'] . "'
                        data-fakultas='" . $row['nama_fakultas'] . "'
                        data-kategori='" . $row['nama_kategori'] . "'
                        data-tahun='" . $row['tahun'] . "'
                        data-rak='" . $row['id_rak'] . "'>Edit</button></td>";
        }
        $data .= "</tr>";
    }
} else {
    $data .= "<tr><td colspan='9'>Tidak ada hasil ditemukan</td></tr>";
}

$pagination = '';
if ($total_pages > 1) {
    $pagination .= '<li class="page-item ' . ($page == 1 ? 'disabled' : '') . '"><a class="page-link" href="#" data-page="' . ($page - 1) . '">Previous</a></li>';
    
    if ($total_pages <= 2) {
        for ($i = 1; $i <= $total_pages; $i++) {
            $active_class = ($i == $page) ? 'active' : '';
            $pagination .= '<li class="page-item ' . $active_class . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
        }
    } else {
        if ($page <= 2) {
            for ($i = 1; $i <= 2; $i++) {
                $active_class = ($i == $page) ? 'active' : '';
                $pagination .= '<li class="page-item ' . $active_class . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
            }
            $pagination .= '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
            $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $total_pages . '">' . $total_pages . '</a></li>';
        } elseif ($page > 2 && $page < $total_pages - 1) {
            $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>';
            $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="2">2</a></li>';
            $pagination .= '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
            for ($i = $page - 1; $i <= $page + 1; $i++) {
                $active_class = ($i == $page) ? 'active' : '';
                $pagination .= '<li class="page-item ' . $active_class . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
            }
            $pagination .= '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
            $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $total_pages . '">' . $total_pages . '</a></li>';
        } else {
            $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>';
            $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="2">2</a></li>';
            $pagination .= '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
            for ($i = $total_pages - 1; $i <= $total_pages; $i++) {
                $active_class = ($i == $page) ? 'active' : '';
                $pagination .= '<li class="page-item ' . $active_class . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
            }
        }
    }
    
    $pagination .= '<li class="page-item ' . ($page == $total_pages ? 'disabled' : '') . '"><a class="page-link" href="#" data-page="' . ($page + 1) . '">Next</a></li>';
}

$start = $offset + 1;
$end = min($offset + $limit, $total_records);
$info = "Showing $start to $end of $total_records entries";

$response = [
    'data' => $data,
    'pagination' => $pagination,
    'info' => $info
];

// Tangkap output buffer dan bersihkan
$output = ob_get_clean();

// Jika ada output yang tidak diinginkan, log ke file
if (!empty($output)) {
    file_put_contents('error_log.txt', $output, FILE_APPEND);
}

// Kembalikan JSON response
echo json_encode($response);

$conn->close();
?>