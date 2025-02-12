<?php
require 'function.php';

// Fetch distinct years from the database for the dropdown
$years_query = "SELECT DISTINCT tahun FROM penelitian ORDER BY tahun DESC";
$years_result = $conn->query($years_query);

// Fetch distinct instances from the database for the dropdown
$instansi_query = "SELECT DISTINCT nama_instansi FROM instansi ORDER BY nama_instansi ASC";
$instansi_result = $conn->query($instansi_query);

// Fetch distinct faculties from the database for the dropdown
$fakultas_query = "SELECT DISTINCT nama_fakultas FROM fakultas ORDER BY nama_fakultas ASC";
$fakultas_result = $conn->query($fakultas_query);

// Fetch distinct categories from the database for the dropdown
$categories_query = "SELECT DISTINCT nama_kategori FROM kategori ORDER BY nama_kategori ASC";
$categories_result = $conn->query($categories_query);

// Fetch distinct locations from the database for the dropdown
$locations_query = "SELECT DISTINCT id_rak FROM rak ORDER BY id_rak ASC";
$locations_result = $conn->query($locations_query);
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
                margin-bottom: 10px;
            }
            .form-inline .d-flex {
                flex-direction: column;
                align-items: stretch;
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

        /* Samakan tinggi elemen input dan dropdown */
        .form-control, .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px); /* Sesuaikan dengan tinggi elemen input */
        }
        /* Aturan khusus untuk placeholder */
        .form-control, .select2-container .select2-selection--single, .select-container select {
        color: #000000 !important; /* Warna teks lebih gelap */
        border: 1px solid #000000; /* Warna border lebih gelap */
        border-radius: 0.25rem; /* Radius border */
        }
        /* Aturan khusus untuk placeholder */
        .form-control::placeholder {
            color: #000000 !important; /* Warna placeholder lebih gelap */
            opacity: 1; /* Pastikan opacity diatur ke 1 untuk menghindari transparansi */
        }
        /* Aturan khusus untuk teks input */
        .form-control {
        color: #000000 !important; /* Warna teks hitam solid */
        }
        /* Aturan khusus untuk teks dropdown */
        .select2-container .select2-selection--single .select2-selection__rendered {
        color: #000000 !important; /* Warna teks hitam solid */
        }
        .btn-clear {
            background-color: #dc3545; /* Background merah */
            color: white; /* Warna teks putih */
        }
        .btn-clear:hover {
        background-color: #c82333; /* Warna merah lebih gelap saat hover */
        color: white; /* Warna teks tetap putih */
        }
        #googleFormModal .modal-dialog {
            max-width: 50vw; /* Sesuaikan lebar modal */
            max-height: 80vh; /* Batasi tinggi modal */
            margin: 10vh auto; /* Beri jarak atas dan bawah */
            display: flex;
            align-items: center; /* Pusatkan modal di layar */
            justify-content: center;
        }

        #googleFormModal .modal-content {
            height: 80vh; /* Batasi tinggi modal */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Pusatkan konten modal */
            align-items: center;
            padding: 10px;
        }

        #googleFormModal .modal-body {
            flex: 1; /* Agar body modal fleksibel */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            overflow: hidden; /* Hilangkan scroll jika tidak perlu */
        }

        #formIframe {
            width: 100%;
            height: 100%;
            display: block;
            border: none;
        }

        #qrCodeImage {
            max-width: 90%;  /* Batasi lebar agar tidak melebihi modal */
            max-height: 100%; /* Pastikan tinggi gambar tidak terpotong */
            width: auto;
            height: auto;
            display: block;
            margin: auto;
            object-fit: contain;
        }
        .modal-body {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0; /* Hapus padding jika perlu */
        }
        .modal-title-container {
        display: flex;
        flex-direction: column; /* Teks otomatis ada di bawah */
        align-items: center; /* Pusatkan teks */
        text-align: center;
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
                <!-- Form Pencarian -->
                <form method="POST" action="" class="row g-2 align-items-center" id="searchForm">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <input class="form-control" type="text" id="search" name="search" 
                            placeholder="Cari Judul/Nama Penulis" aria-label="Cari Judul/Nama Penulis">
                    </div>
                    <!-- Dropdown Instansi -->
                     <div class="col-lg-3 col-md-3 col-sm-12">
                        <select class="form-control" id="instansi" name="instansi">
                            <option value="">Pilih Instansi</option>
                            <?php while ($instansi_row = mysqli_fetch_assoc($instansi_result)) { ?>
                                <option value="<?php echo $instansi_row['nama_instansi']; ?>">
                                    <?php echo $instansi_row['nama_instansi']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- Dropdown Fakultas -->
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <select class="form-control" id="fakultas" name="fakultas">
                            <option value="">Pilih Fakultas</option>
                            <?php while ($fakultas_row = mysqli_fetch_assoc($fakultas_result)) { ?>
                                <option value="<?php echo $fakultas_row['nama_fakultas']; ?>">
                                    <?php echo $fakultas_row['nama_fakultas']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <select class="form-control" id="year" name="year">
                            <option value="">Pilih Tahun</option>
                            <?php while ($year_row = mysqli_fetch_assoc($years_result)) { ?>
                                <option value="<?php echo $year_row['tahun']; ?>">
                                    <?php echo $year_row['tahun']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <select class="form-control" id="category" name="category">
                            <option value="">Pilih Kategori</option>
                            <?php while ($category_row = mysqli_fetch_assoc($categories_result)) { ?>
                                <option value="<?php echo $category_row['nama_kategori']; ?>">
                                    <?php echo $category_row['nama_kategori']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <select class="form-control" id="location" name="location">
                            <option value="">Pilih Lokasi</option>
                            <?php while ($locations_row = mysqli_fetch_assoc($locations_result)) { ?>
                                <option value="<?php echo $locations_row['id_rak']; ?>">
                                    <?php echo $locations_row['id_rak']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-12 d-flex ms-auto justify-content-end">
                        <button type="button" class="btn btn-clear me-2" id="clearSearch">Clear</button>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>

            <div class="table-responsive">
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
            </div>

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
<!-- Tambahkan modal untuk Google Form -->
<div class="modal fade" id="googleFormModal" tabindex="-1" aria-labelledby="googleFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title-container">
                    <h5 class="modal-title" id="googleFormModalLabel">Formulir Pengunjung E-Bray</h5>
                    <span id="googleFormText">Silahkan scan dan isi formulir pengunjung di bawah ini terlebih dahulu!</span>
                </div>
                <div class="d-flex align-items-center ms-auto">
                </div>
            </div>
            <div class="modal-body">
                <img src="assets/img/form-pengunjung.png" alt="QR Code" id="qrCodeImage">
            </div>
            <div class="modal-footer">
                <!-- ubah tombol selesai agar dia menutup modal -->
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Selesai</button>
            </div>
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
        // Hapus localStorage kecuali jika reload terjadi karena tombol search
        if (!sessionStorage.getItem("searchReload")) {
            localStorage.removeItem("formFilled");
            localStorage.removeItem("search");
            localStorage.removeItem("instansi");
            localStorage.removeItem("fakultas");
            localStorage.removeItem("year");
            localStorage.removeItem("category");
            localStorage.removeItem("location");
        }

        // Reset indikator reload setelah halaman dimuat
        sessionStorage.removeItem("searchReload");

         // Cek apakah ini refresh manual atau bukan
        if (!sessionStorage.getItem("preventPopup")) {
            $('#googleFormModal').modal('show'); // Tampilkan modal
        }

        // Inisialisasi Select2 pada elemen dropdown
        $('#year, #category, #instansi, #fakultas, #location').select2();

        // Ambil nilai pencarian dari localStorage dan isi kembali form pencarian
        if (localStorage.getItem('search')) {
            $('#search').val(localStorage.getItem('search'));
        }
        if (localStorage.getItem('instansi')) {
            $('#instansi').val(localStorage.getItem('instansi')).trigger('change');
        }
        if (localStorage.getItem('fakultas')) {
            $('#fakultas').val(localStorage.getItem('fakultas')).trigger('change');
        }
        if (localStorage.getItem('year')) {
            $('#year').val(localStorage.getItem('year')).trigger('change');
        }
        if (localStorage.getItem('category')) {
            $('#category').val(localStorage.getItem('category')).trigger('change');
        }
        if (localStorage.getItem('location')) {
            $('#location').val(localStorage.getItem('location')).trigger('change');
        }

        function fetchData(page = 1) {
            $.ajax({
                url: 'search.php',
                type: 'POST',
                data: {
                    search: $('#search').val(),
                    instansi: $('#instansi').val(),
                    fakultas: $('#fakultas').val(),
                    year: $('#year').val(),
                    category: $('#category').val(),
                    location: $('#location').val(),
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

        $('#search, #year, #category, #instansi, #fakultas, #location').on('input', function() {
            fetchData();
        });

        $('#searchForm').on('change', function(e) {
            e.preventDefault();
            fetchData();
        });

        // Simpan nilai pencarian di localStorage sebelum halaman di-reload
        $('#searchForm').on('submit', function(e) {
            sessionStorage.setItem("preventPopup", "1");
            sessionStorage.setItem("searchReload", "1"); // Tandai reload akibat tombol search
            localStorage.setItem('search', $('#search').val());
            localStorage.setItem('instansi', $('#instansi').val());
            localStorage.setItem('fakultas', $('#fakultas').val());
            localStorage.setItem('year', $('#year').val());
            localStorage.setItem('category', $('#category').val());
            localStorage.setItem('location', $('#location').val());
        });

        // Tambahkan fungsi untuk tombol "X" untuk menghapus semua pencarian
        $('#clearSearch').on('click', function() {
            $('#search').val('');
            $('#instansi').val('').trigger('change');
            $('#fakultas').val('').trigger('change');
            $('#year').val('').trigger('change');
            $('#category').val('').trigger('change');
            $('#location').val('').trigger('change');
            localStorage.removeItem('search');
            localStorage.removeItem('instansi');
            localStorage.removeItem('fakultas');
            localStorage.removeItem('year');
            localStorage.removeItem('category');
            localStorage.removeItem('location');
            fetchData();
        });
   
        fetchData();

        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            fetchData(page);
        });
        sessionStorage.removeItem("preventPopup");
        sessionStorage.removeItem("searchReload");
    });
</script>
</body>
</html>