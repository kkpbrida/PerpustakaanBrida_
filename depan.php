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

        .form-inline .form-control,
        .form-inline .btn,
        .form-inline .select {
            width: 100%;
        }

        .form-inline .row {
            width: 100%;
            margin-left: -0px; /* Adjust this value to shift the columns to the left */
        }

        .form-inline .col-lg-6,
        .form-inline .col-lg-3 {
            padding-right: 0;
            padding-left: 0;
        }

        .form-inline .col-lg-6 {
            flex: 0 0 auto;
            width: 50%;
        }

        .form-inline .col-lg-3 {
            flex: 0 0 auto;
            width: 25%;
        }

        .select-wrapper {
            position: relative;
        }

        .select-wrapper select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding-right: 30px; /* Adjust this value to make space for the icon */
        }

        .select-wrapper::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 10px;
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #000;
            transform: translateY(-50%);
            pointer-events: none;
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
            <form method="POST" action="" class="form-inline" id="searchForm">
                <div class="row g-3">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <input class="form-control w-100" type="text" id="search" name="search" 
                            placeholder="Cari Judul/Nama Penulis" aria-label="Cari Judul/Nama Penulis" />
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="select-wrapper">
                            <select class="form-control w-100" id="year" name="year">
                                <option value="">Pilih Tahun</option>
                                <?php while ($year_row = mysqli_fetch_assoc($years_result)) { ?>
                                    <option value="<?php echo $year_row['tahun']; ?>">
                                        <?php echo $year_row['tahun']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="select-wrapper">
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
            <div class="text-muted">Copyright &copy; KKP ILMU KOMPUTER</div>
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

    // Prevent form submission on Enter key press
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
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