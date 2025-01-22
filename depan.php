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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            max-height: 200px; /* Set the maximum height */
            overflow-y: auto; /* Add vertical scrollbar if needed */
        }

        /* Hapus ikon panah kustom */
        .select-wrapper::after {
            display: none;
        }

        .pagination .page-link {
                    background-color: #FFC107;
                    color: black;
                }
                .pagination .page-link:hover {
                    background-color: #e0a800;
                    color: black;
                }
                .pagination .page-item.active .page-link {
                    background-color: #003366;
                    border-color: #FFC107;
                }


        /* Samakan tinggi elemen input dan dropdown */
        .form-control, .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px); /* Sesuaikan dengan tinggi elemen input */
        }
    </style>
</head>
<body>
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="d-flex align-items-center">
            <img src="assets/img/instansi-logo.png" alt="Logo BRIDA" height="40" class="me-2">
            <h1>Selamat Datang di E-Library Perpustakaan BRIDA</h1>
        </div>
        <div>
            <a href="home.php" class="btn" style="background-color: #FFC107; color: black;">Home</a>
            <a href="login.php" class="btn" style="background-color: #FFC107; color: black;">Login</a>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"> </li>
    </ol>
<div class="card mb-4">
    <div class="card-header text-center" style="background-color: #003366; color: white;">
        <i class="fas fa-book me-1"></i> <!-- Ikon perpustakaan di sebelah kiri -->
        <i class="fas fa-university me-1"></i>
        <span>Daftar Penelitian</span>
        <i class="fas fa-university ms-1"></i>
        <i class="fas fa-book ms-1"></i> <!-- Ikon perpustakaan di sebelah kanan -->
    </div>
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
            <table class="table table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Nama Penulis</th>
                        <th>Instansi</th>
                        <th>Fakultas</th>
                        <th>Tahun</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data akan dimuat di sini melalui AJAX -->
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <div id="data-info" class="mb-3"></div>
                <div id="total-records" class="mb-3"></div>
            </div>
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
            <div class="text-muted"> &copy; KKP Ilmu Komputer UHO 2025</div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script>
$(document).ready(function() {
    // Inisialisasi Select2 pada elemen dropdown
    $('#year, #category').select2();

    function fetchData(page = 1) {
        $.ajax({
            url: 'search.php',
            type: 'POST',
            data: {
                search: $('#search').val(),
                year: $('#year').val(),
                category: $('#category').val(),
                page: page,
                page_type: 'depan'
            },
            success: function(data) {
                try {
                    $('#data-table tbody').html(data.data);
                    $('#pagination').html(data.pagination);
                    $('#data-info').html(data.info);
                    $('#total-records').html(data.total_records);
                } catch (e) {
                    console.error("Parsing error:", e);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error:", status, error);
            }
        });
    }

    $('#search, #year, #category').on('input', function() {
        fetchData();
    });

    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        fetchData();
    });

    fetchData();

    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        fetchData(page);
    });
});
</script>
</body>