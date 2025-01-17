<?php
require 'function.php';

// Fetch distinct years from the database for the dropdown
$years_query = "SELECT DISTINCT tahun FROM penelitian ORDER BY tahun DESC";
$years_result = $conn->query($years_query);

// Fetch distinct categories from the database for the dropdown
$categories_query = "SELECT DISTINCT nama_kategori FROM kategori ORDER BY nama_kategori ASC";
$categories_result = $conn->query($categories_query);
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
    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
      
        @media (max-width: 768px) {
            .form-inline .form-control {
                width: 100%;
                margin-bottom: 10px;
            }
            .form-inline .btn {
                width: 100%;
            }
        }
    </style>
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
        <li class="breadcrumb-item active">Halaman Pencarian Penelitian</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Penelitian
        </div>
        <div class="card-body">
            <form method="POST" action="" class="form-inline">
                <div class="row g-3">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <input class="form-control w-100" type="text" id="search" name="search" 
                            placeholder="Cari Judul/Nama Penulis" aria-label="Cari Judul/Nama Penulis" />
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <select class="form-control w-100" id="year" name="year">
                            <option value="">Pilih Tahun</option>
                            <?php while ($year_row = mysqli_fetch_assoc($years_result)) { ?>
                                <option value="<?php echo $year_row['tahun']; ?>">
                                    <?php echo $year_row['tahun']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <select class="form-control w-100" id="category" name="category">
                            <option value="">Pilih Kategori</option>
                            <?php while ($category_row = mysqli_fetch_assoc($categories_result)) { ?>
                                <option value="<?php echo $category_row['nama_kategori']; ?>">
                                    <?php echo $category_row['nama_kategori']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Nama Penulis</th>
                        <th>Fakultas</th>
                        <th>Instansi</th>
                        <th>Tahun</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>
                <tbody id="results">
                    <!-- Data akan dimuat di sini melalui AJAX -->
                </tbody>
            </table>
            <div id="data-info" class="mb-3"></div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center" id="pagination">
                    <!-- Pagination links will be generated here -->
                </ul>
            </nav>
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
<script>
$(document).ready(function() {
    function fetchData(page = 1) {
        var search = $('#search').val();
        var year = $('#year').val();
        var category = $('#category').val();
        $.ajax({
            url: 'search.php',
            method: 'POST',
            data: { search: search, year: year, category: category, page: page },
            success: function(response) {
                var data = JSON.parse(response);
                $('#results').html(data.data);
                $('#pagination').html(data.pagination);
                $('#data-info').html(data.info);
            }
        });
    }

    $('#search, #year, #category').on('input', function() {
        fetchData();
    });

    // Fetch initial data
    fetchData();

    // Handle pagination click
    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        fetchData(page);
    });
});
</script>
</body>
</html>