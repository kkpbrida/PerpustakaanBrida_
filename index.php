<?php
require_once 'function.php';
require_once 'cek.php';

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
    <title>Dashboard - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
      
        .form-inline .form-control,
        .form-inline .btn {
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
    
        .navbar {
            display: flex;
            justify-content: space-between; /* Kiri dan kanan */
            align-items: center; /* Vertikal sejajar */
        }

        .navbar-left {
            display: flex;
            gap: 10px; /* Jarak antar ikon di kiri */
        }

        .navbar-right {
            display: flex;
            gap: 10px; /* Jarak antar ikon di kanan */
            margin-left: auto; /* Geser ke kanan */
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

        /* Hapus ikon panah kustom */
        .select-wrapper::after {
            display: none;
        }

        /* Samakan tinggi elemen input dan dropdown */
        .form-control, .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px); /* Sesuaikan dengan tinggi elemen input */
        }
        .select-container {
            position: relative;
        }
        .select-container select {
            width: 100%;
            padding-right: 30px; /* Adjust this value based on the icon size */
        }
        .select-container .fa-caret-down {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }
    </style>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="dashboard.php">E-BRAY</a>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-3 me-lg-4">
        <li class="nav-item">
            <a class="nav-link" href="home.php"><i class="fas fa-home"></i> Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="fas fa-clipboard-list"></i> Penelitian</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="depan-admin.php"><i class="fas fa-search"></i> Search</a>
        </li>
    </ul>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
    </nav>
    </nav>
        <div style="margin-top: 56px;"></div> <!-- Batasan untuk menghindari overlap dengan navbar -->
        </nav>
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Penelitian</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Admin</li>
                    </ol> 
                    <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-table me-1"></i>
                                Daftar Penelitian
                            </div>
                            <a href="form.php" class="btn btn-warning">Tambah Penelitian</a>
                        </div>
                        <div class="card-header d-flex justify-content-between align-items-center">
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
                                        <th>Instansi</th>
                                        <th>Fakultas</th>
                                        <th>Tahun</th>
                                        <th>Kategori</th>
                                        <th>Lokasi</th>
                                        <th>Tanggal Masuk</th>
                                        <th colspan="2" style="text-align: center;">Aksi</th> <!-- Pusatkan teks di header -->
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
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Kuliah Kerja Praktik Ilmu Komputer 2025 Universitas Halu Oleo</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script>
    $(document).ready(function() {
        // Inisialisasi Select2 pada elemen dropdown
        $('#year, #category').select2();

        function fetchData(page = 1) {
            var search = $('#search').val();
            var year = $('#year').val();
            var category = $('#category').val();
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: {
                    search: search,
                    year: year,
                    category: category,
                    page: page,
                    page_type: 'index'
                },
                success: function(response) {
                    $('#results').html(response.data);
                    $('#pagination').html(response.pagination);
                    $('#data-info').html(response.info);
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

        // Handle edit button click
        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();

            // Ambil data dari tombol
            var id = $(this).data('id');
            var tgl_masuk = $(this).data('tgl_masuk');
            var judul = $(this).data('judul');
            var nama_penulis = $(this).data('nama_penulis');
            var instansi = $(this).data('instansi');
            var fakultas = $(this).data('fakultas');
            var kategori = $(this).data('kategori');
            var tahun = $(this).data('tahun');
            var rak = $(this).data('rak');
        
            
            // Debugging: Log the values to the console
            console.log({
                id,
                tgl_masuk,
                judul,
                nama_penulis,
                instansi,
                fakultas,
                kategori,
                tahun,
                rak
            });
            
            // Set data ke form
            $('#editId').val(id);
            $('#editTgl_masuk').val(tgl_masuk);
            $('#editJudul').val(judul);

            // Set data nama_penulis (jika array, buat kolom input dinamis)
            $('#editPenulisContainer').empty(); // Kosongkan container sebelumnya
            if (nama_penulis) {
                var penulisArray = nama_penulis.split(', '); // Pastikan dipisah dengan delimiter yang sesuai
                penulisArray.forEach(function (penulis, index) {
                    if (index === 0) {
                        $('#editNamaPenulis').val(penulis); // Kolom pertama
                    } else {
                        $('#editPenulisContainer').append(`
                            <input type="text" name="nama_penulis[]" class="form-control mt-2" value="${penulis}" required>
                        `);
                    }
                });
            }

            // Set fakultas, kategori, tahun, rak ke dropdown
            $('#editInstansi option').filter(function() {
                return $(this).text() === instansi;
            }).prop('selected', true);
            $('#editFakultas option').filter(function() {
                return $(this).text() === fakultas;
            }).prop('selected', true);
            $('#editKategori option').filter(function() {
                return $(this).text() === kategori;
            }).prop('selected', true);
            $('#editTahun').val(tahun);
            $('#editRak').val(rak);

            // Tampilkan modal
            $('#editModal').modal('show');
        });

        // Handle form submission
            $('#editForm').on('submit', function(e) {
            e.preventDefault();
            
            $.ajax({
                url: 'update_penelitian.php',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    // Disable submit button
                    $('#editForm button[type="submit"]').prop('disabled', true);
                },
                success: function(response) {
                    console.log('Response:', response); // Debug log
                    if (response.success) {
                        $('#editModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message || 'Terjadi kesalahan saat memperbarui data',
                            showConfirmButton: true
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', xhr.responseText); // Debug log
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan pada server',
                        showConfirmButton: true
                    });
                },
                complete: function() {
                    // Re-enable submit button
                    $('#editForm button[type="submit"]').prop('disabled', false);
                }
            });
        });



        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
        
            // Show confirmation dialog
            if (confirm("Are you sure you want to delete this record?")) {
                // Kirimkan request ke server untuk menghapus data penelitian
                $.ajax({
                    url: 'delete.php',
                    type: 'POST',
                    data: {id: id},
                    success: function(response) {
                        // Tampilkan pesan sukses
                        alert('Data berhasil dihapus!');
                        // Refresh data
                        fetchData();
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error); // Tampilkan pesan kesalahan
                    }
                });
            }
        });
    });
    </script>
    
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Penelitian</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editForm">
              <input type="hidden" id="editId" name="id_penelitian">
              <div class="mb-3">
                <label for="editTgl_masuk" class="form-label">Tanggal Registrasi:</label>
                <input type="date" class="form-control" id="editTgl_masuk" name="tgl_masuk" required>
              </div>
              <div class="mb-3">
                <label for="editJudul" class="form-label">Judul:</label>
                <input type="text" class="form-control" id="editJudul" name="judul" required>
              </div>
              <div class="mb-3">
                <label for="editNamaPenulis" class="form-label">Nama Penulis:</label>
                <input type="text" id="editNamaPenulis" name="nama_penulis[]" class="form-control" required>
                <div id="editPenulisContainer"></div>
                <button type="button" class="btn btn-secondary mt-2" id="addEditPenulisBtn" onclick="addEditPenulis()">Tambah Penulis</button>
                <button type="button" class="btn btn-danger mt-2" id="removeEditPenulisBtn" onclick="removeEditPenulis()" style="display: none;">Hapus</button>
              </div>
              <script>
                function addEditPenulis() {
                    var container = document.getElementById('editPenulisContainer');
                    var totalInputs = container.querySelectorAll('input[name="nama_penulis[]"]').length;

                    if (totalInputs >= 9) { // Kolom awal + 9 = 10
                        var button = document.getElementById('addEditPenulisBtn');
                        button.disabled = true;
                        button.textContent = 'Batas Maksimal Tercapai';
                        button.classList.remove('btn-secondary');
                        button.classList.add('btn-danger');
                        return;
                    }

                    var input = document.createElement('input');
                    input.type = 'text';
                    input.name = 'nama_penulis[]';
                    input.className = 'form-control mt-2';
                    input.required = true;
                    container.appendChild(input);

                    // Show the remove button if there are more than one input fields
                    if (totalInputs + 1 > 0) {
                        document.getElementById('removeEditPenulisBtn').style.display = 'inline-block';
                    }
                }

                function removeEditPenulis() {
                    var container = document.getElementById('editPenulisContainer');
                    var totalInputs = container.querySelectorAll('input[name="nama_penulis[]"]').length;

                    if (totalInputs > 0) {
                        container.removeChild(container.lastChild);
                    }

                    // Hide the remove button if there is only one input field left
                    if (totalInputs - 1 <= 0) {
                        document.getElementById('removeEditPenulisBtn').style.display = 'none';
                    }

                    // Re-enable the add button if it was disabled
                    var addButton = document.getElementById('addEditPenulisBtn');
                    if (totalInputs <= 10) {
                        addButton.disabled = false;
                        addButton.textContent = 'Tambah Penulis';
                        addButton.classList.remove('btn-danger');
                        addButton.classList.add('btn-secondary');
                    }
                }

                // Initial check to hide the remove button if there is only one input field
                document.addEventListener('DOMContentLoaded', function() {
                    var totalInputs = document.querySelectorAll('input[name="nama_penulis[]"]').length;
                    if (totalInputs <= 1) {
                        document.getElementById('removeEditPenulisBtn').style.display = 'none';
                    }
                });
              </script>
              <div class="mb-3">
                <label for="editInstansi" class="form-label">Instansi:</label>
                <div class="select-container">
                    <select id="editInstansi" name="instansi" class="form-control" required>
                        <option value="" disabled selected>Pilih instansi</option>
                        <?php
                            $getdata = mysqli_query($conn, "SELECT * FROM instansi");
                            if (!$getdata) {
                                die(ERROR_FETCHING_DATA . mysqli_error($conn));
                            }
                            while ($fetcharray = mysqli_fetch_array($getdata)) {
                                $nama_instansi = $fetcharray['nama_instansi'];
                                $id_instansi = $fetcharray['id_instansi'];
                        ?>
                        <option value="<?php echo $id_instansi; ?>"><?php echo $nama_instansi; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <i class="fa fa-caret-down"></i>
                </div>
              </div>
              <div class="mb-3">
                <label for="editFakultas" class="form-label">Fakultas:</label>
                <div class="select-container">
                    <select id="editFakultas" name="fakultas" class="form-control" required>
                        <option value="" disabled selected>Pilih Fakultas</option>
                        <?php
                            $getdata = mysqli_query($conn, "SELECT * FROM fakultas");
                            if (!$getdata) {
                                die("Error fetching data: " . mysqli_error($conn));
                            }
                            while ($fetcharray = mysqli_fetch_array($getdata)) {
                                $nama_fakultas = $fetcharray['nama_fakultas'];
                                $id_fakultas = $fetcharray['id_fakultas'];
                        ?>
                        <option value="<?php echo $id_fakultas; ?>"><?php echo $nama_fakultas; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <i class="fa fa-caret-down"></i>
                </div>
              </div>
              <div class="mb-3">
                <label for="editKategori" class="form-label">Kategori:</label>
                <div class="select-container">
                    <select id="editKategori" name="kategori" class="form-control" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        <?php
                            $getdata = mysqli_query($conn, "SELECT * FROM kategori");
                            if (!$getdata) {
                                die("Error fetching data: " . mysqli_error($conn));
                            }
                            while ($fetcharray = mysqli_fetch_array($getdata)) {
                                $nama_kategori = $fetcharray['nama_kategori'];
                                $id_kategori = $fetcharray['id_kategori'];
                        ?>
                        <option value="<?php echo $id_kategori; ?>"><?php echo $nama_kategori; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <i class="fa fa-caret-down"></i>
                </div>
              </div>
              <div class="mb-3">
                <label for="editTahun" class="form-label">Tahun:</label>
                <div class="select-container">
                    <select id="editTahun" name="tahun" class="form-control" required>
                        <option value="" disabled selected>Pilih Tahun</option>
                        <?php
                            for ($year = 2019; $year <= 2029; $year++) {
                                echo "<option value='$year'>$year</option>";
                            }
                        ?>
                    </select>
                    <i class="fa fa-caret-down"></i>
                </div>
              </div>
              <div class="mb-3">
                <label for="editRak" class="form-label">Rak:</label>
                <div class="select-container">
                    <select id="editRak" name="rak" class="form-control" required>
                        <option value="" disabled selected>Pilih Rak</option>
                        <?php
                            $getdata = mysqli_query($conn, "SELECT id_rak FROM rak");
                            if (!$getdata) {
                                die("Error fetching data: " . mysqli_error($conn));
                            }
                            while ($fetcharray = mysqli_fetch_array($getdata)) {
                                $id_rak = $fetcharray['id_rak'];
                        ?>
                        <option value="<?php echo $id_rak; ?>"><?php echo $id_rak; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <i class="fa fa-caret-down"></i>
                </div>
              </div>
              <script>
                    
                    // Create FormData object
                    const formData = new FormData(this);
                    
                    // Send AJAX request
                    fetch('update_penelitian.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                    // Close the modal
                    console.log(data); // Lihat respons sebenarnya
                    try {
                        const jsonData = JSON.parse(data); // Parsing JSON
                        if (jsonData.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: jsonData.message || 'Data penelitian berhasil diperbarui',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => location.reload());
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: jsonData.message || 'Terjadi kesalahan saat memperbarui data',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    } catch (error) {
                        console.error('Invalid JSON response', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat memproses respons server',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan pada server',
                        timer: 2000,
                        showConfirmButton: false
                    });
                });

                });
             </script>
              <script>
                document.querySelectorAll('.select-container select').forEach(function(select) {
                    select.addEventListener('focus', function() {
                        this.nextElementSibling.classList.add('rotate');
                    });
                    select.addEventListener('blur', function() {
                        this.nextElementSibling.classList.remove('rotate');
                    });
                    select.addEventListener('change', function() {
                        this.nextElementSibling.classList.remove('rotate');
                    });
                });
              </script>
              <style>
                .fa-caret-down.rotate {
                    transform: translateY(-50%) rotate(180deg);
                }
                .select-container select {
                    max-height: 200px;
                    overflow-y: auto;
                }
              </style>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>
</html>