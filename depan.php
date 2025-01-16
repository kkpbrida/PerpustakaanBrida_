<?php
require 'function.php';

// Fetch distinct years from the database for the dropdown
$years_query = "SELECT DISTINCT tahun FROM penelitian ORDER BY tahun DESC";
$years_result = $conn->query($years_query);

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4">
    <h1>Selamat Datang di e-Library Perpustakaan BRIDA</h1>
    <div>
        <a href="home.php" class="btn btn-secondary">Home</a>
        <a href="login.php" class="btn btn-primary">Login</a>
    </div>
    </div>
    <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Daftar Penelitian
    </div>
    <div class="card-body">
        <form method="POST" action="">
        <div class="input-group mb-3">
            <input class="form-control" type="text" id="search" name="search" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" value="<?php echo $search; ?>" />
            <select class="form-control" id="year" name="year" style="max-width: 150px;">
            <option value="">Select Year</option>
            <?php while ($year_row = mysqli_fetch_assoc($years_result)) { ?>
                <option value="<?php echo $year_row['tahun']; ?>" <?php if ($year == $year_row['tahun']) echo 'selected'; ?>>
                <?php echo $year_row['tahun']; ?>
                </option>
            <?php } ?>
            </select>
        </div>
        </form>
        <table id="datatablesSimple" class="table table-striped">
        <thead>
            <tr>
            <th>Judul</th>
            <th>Nama Penulis</th>
            <th>Fakultas</th>
            <th>Instansi</th>
            <th>Tahun</th>
            <th>Kategori</th>
            </tr>
        </thead>
        <tbody id="results">
            <?php
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['judul'] . "</td><td>" . $row['nama_penulis'] . "</td><td>" . $row['nama_fakultas'] . "</td><td>" . $row['nama_instansi'] . "</td><td>" . $row['tahun'] . "</td><td>" . $row['nama_kategori'] . "</td></tr>";
            }
            } else {
            echo "<tr><td colspan='6'>Tidak ada hasil ditemukan</td></tr>";
            }
            ?>
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
<script>
$(document).ready(function() {
    $('#search, #year').on('input', function() {
    var search = $('#search').val();
    var year = $('#year').val();
    $.ajax({
        url: 'search.php',
        method: 'POST',
        data: { search: search, year: year },
        success: function(response) {
        $('#results').html(response);
        }
    });
    });
});
</script>
</body>
</html>
<?php
$conn->close();
?>