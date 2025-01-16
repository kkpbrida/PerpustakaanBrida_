<?php
require 'function.php';
require 'cek.php';

// Fetch distinct years from the database for the dropdown
$years_query = "SELECT DISTINCT tahun FROM penelitian ORDER BY tahun DESC";
$years_result = mysqli_query($conn, $years_query);

$search = '';
$selected_year = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $selected_year = $_POST['year'];
    $query = "SELECT p.judul, i.nama_instansi, f.nama_fakultas, p.tahun, p.nama_penulis, k.nama_kategori 
              FROM penelitian p
              JOIN fakultas f ON p.id_fakultas = f.id_fakultas
              JOIN instansi i ON f.id_instansi = i.id_instantsi
              JOIN kategori k ON p.id_kategori = k.id_kategori
              WHERE (MATCH(p.judul, p.nama_penulis) AGAINST('$search' IN NATURAL LANGUAGE MODE)
              OR i.nama_instansi LIKE '%$search%'
              OR f.nama_fakultas LIKE '%$search%'
              OR k.nama_kategori LIKE '%$search%'
              OR p.id_fakultas LIKE '%$search%'
              OR p.id_kategori LIKE '%$search%'
              OR p.id_rak LIKE '%$search%'
              OR p.id_registrasi LIKE '%$search%')";
    if ($selected_year != '') {
        $query .= " AND p.tahun = $selected_year";
    }
} else {
    $query = "SELECT p.judul, i.nama_instansi, f.nama_fakultas, p.tahun, p.nama_penulis, k.nama_kategori 
              FROM penelitian p
              JOIN fakultas f ON p.id_fakultas = f.id_fakultas
              JOIN instansi i ON f.id_instansi = i.id_instantsi
              JOIN kategori k ON p.id_kategori = k.id_kategori";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>e-Library BRIDA</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h1>SELAMAT DATANG DI SIAP BRIDA</h1>
        <a href="login.php" class="btn btn-primary">Login</a>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Buku
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="input-group mb-3">
                    <input class="form-control" type="text" name="search" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" value="<?php echo $search; ?>" />
                    <select class="form-control" name="year" style="max-width: 150px;">
                        <option value="">Select Year</option>
                        <?php while ($year_row = mysqli_fetch_assoc($years_result)) { ?>
                            <option value="<?php echo $year_row['tahun']; ?>" <?php if ($selected_year == $year_row['tahun']) echo 'selected'; ?>>
                                <?php echo $year_row['tahun']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Instansi</th>
                        <th>Fakultas</th>
                        <th>Tahun</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Judul</th>
                        <th>Instansi</th>
                        <th>Fakultas</th>
                        <th>Tahun</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['judul']; ?></td>
                            <td><?php echo $row['nama_instansi']; ?></td>
                            <td><?php echo $row['nama_fakultas']; ?></td>
                            <td><?php echo $row['tahun']; ?></td>
                            <td><?php echo $row['nama_penulis']; ?></td>
                            <td><?php echo $row['nama_kategori']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; kkp ilkom nihh bozzz</div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>