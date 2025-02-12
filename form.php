<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tambah Penelitian</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <style>
            .select-container {
                display: flex;
                flex-direction: column;
                width: 100%; /* Sesuaikan dengan container parent */
            }

            .select-container select {
                width: 100%; /* Pastikan inputan menyesuaikan */
                box-sizing: border-box; /* Mencegah overflow */
                height: calc(2.25rem + 2px); /* Konsisten dengan tinggi elemen lainnya */
                font-size: 1rem; /* Tetap proporsional */
                padding: 0.375rem 0.75rem;
                border: 1px solid #ced4da;
                border-radius: 0.375rem;
                background-color: #fff;
                transition: all 0.2s ease-in-out; /* Transisi lembut saat window berubah */
}

            form .form-control {
                width: 100%;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                color: #212529;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                border-radius: 0.375rem;
                box-shadow: inset 0 0 0 transparent;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                height: auto; /* Pastikan height diatur otomatis */
            }

            .select2-container--default .select2-selection--single {
                width: 100%;
                height: calc(2.25rem + 2px); /* Sesuaikan dengan tinggi box input lainnya */
                padding: 0.375rem 0.75rem; /* Sama dengan input */
                font-size: 1rem;
                line-height: 1.5;
                color: #212529;
                border: 1px solid #ced4da;
                border-radius: 0.375rem;
            }
            .close-icon {
                font-size: 1.5rem;
                color: #000;
                text-decoration: none;
            }

            .close-icon:hover {
                color: #ff0000;
            }
        </style>
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
                <a class="nav-link" href="depan-admin.php"><i class="fas fa-plus"></i> Add Data</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
        </nav>
        </nav>
            <!-- Batasan untuk menghindari overlap dengan navba -->
            <div style="margin-top: 56px;"></div> 
            </nav>
                <main>
                    <div class="container-fluid px-4">
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <h1>Tambah Penelitian</h1>
                            <!-- Close icon -->
                            <a href="index.php" class="close-icon" title="Close">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="form.php" method="post">
                                    <div class="mb-3">
                                        <label for="tgl_masuk" class="form-label">Tanggal Registrasi:</label>
                                        <input type="date" id="tgl_masuk" name="tgl_masuk" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul:</label>
                                        <input type="text" id="judul" name="judul" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_penulis" class="form-label">Nama Penulis:</label>
                                        <input type="text" id="nama_penulis" name="nama_penulis[]" class="form-control" required>
                                        <div id="penulis_container"></div>
                                        <button type="button" class="btn btn-secondary mt-2" id="addPenulisBtn" onclick="addPenulis()">Tambah Penulis</button>
                                        <button type="button" class="btn btn-danger mt-2" id="removePenulisBtn" onclick="removePenulis()" style="display: none;">Hapus</button>
                                    </div>
                                    <div class="mb-3">
                                        <label for="instansi" class="form-label">Instansi:</label>
                                        <div class="select-container">
                                            <select id="instansi" name="instansi" class="form-control" required>
                                                <option value="" disabled selected>Pilih Instansi</option>
                                                <?php
                                                    $getdata = mysqli_query($conn, "SELECT * FROM instansi ORDER BY nama_instansi ASC");
                                                    if (!$getdata) {
                                                        die("Error fetching data: " . mysqli_error($conn));
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
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fakultas" class="form-label">Fakultas:</label>
                                        <div class="select-container">
                                            <select id="fakultas" name="fakultas" class="form-control" required>
                                                <option value="" disabled selected>Pilih Fakultas</option>
                                                <?php
                                                    $getdata = mysqli_query($conn, "SELECT * FROM fakultas ORDER BY nama_fakultas ASC");
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
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Kategori:</label>
                                        <div class="select-container">
                                            <select id="kategori" name="kategori" class="form-control" required>
                                                <option value="" disabled selected>Pilih Kategori</option>
                                                <?php
                                                    $getdata = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
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
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tahun" class="form-label">Tahun:</label>
                                        <input type="text" id="tahun" name="tahun" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rak" class="form-label">Rak:</label>
                                        <div class="select-container">
                                            <select id="rak" name="rak" class="form-control" required>
                                                <option value="" disabled selected>Pilih Rak</option>
                                                <?php
                                                    $getdata = mysqli_query($conn, "SELECT id_rak FROM rak ORDER BY id_rak ASC");
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
                                        </div>
                                    </div>
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
                                    <button type="submit" class="btn btn-primary" name="addpenelitian">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"> &copy; KKP Ilmu Komputer UHO 2025</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script>
         // Fungsi untuk menyesuaikan ukuran box input
        function adjustInputWidth() {
            document.querySelectorAll('.select-container select').forEach(function(select) {
                select.style.width = '100%'; // Pastikan lebar selalu 100% dari kontainer
                select.style.boxSizing = 'border-box'; // Hindari overflow
            });

            document.querySelectorAll('.form-control').forEach(function(input) {
                input.style.width = '100%'; // Pastikan lebar input juga mengikuti ukuran kontainer
                input.style.boxSizing = 'border-box'; // Hindari overflow
            });
        }

        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', adjustInputWidth);

        // Panggil fungsi saat jendela diubah ukurannya
        window.addEventListener('resize', adjustInputWidth);

        $(document).ready(function() {
            $('#instansi, #fakultas, #kategori, #rak').select2({
                width: 'resolve' // Pastikan lebar sesuai kontainer
            });

            // Reset dropdowns to default values on form reset
            $('form').on('reset', function() {
                setTimeout(function() {
                    $('#instansi').val(null).trigger('change');
                    $('#fakultas').val(null).trigger('change');
                    $('#kategori').val(null).trigger('change');
                    $('#rak').val(null).trigger('change');
                }, 0);
            });
        });

        function addPenulis() {
            var container = document.getElementById('penulis_container');
            var totalInputs = container.querySelectorAll('input[name="nama_penulis[]"]').length;

            if (totalInputs >= 9) { // Kolom awal + 9 = 10
                var button = document.getElementById('addPenulisBtn');
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
                document.getElementById('removePenulisBtn').style.display = 'inline-block';
            }
        }

        function removePenulis() {
            var container = document.getElementById('penulis_container');
            var totalInputs = container.querySelectorAll('input[name="nama_penulis[]"]').length;

            if (totalInputs > 0) {
                container.removeChild(container.lastChild);
            }

            // Hide the remove button if there is only one input field left
            if (totalInputs - 1 <= 0) {
                document.getElementById('removePenulisBtn').style.display = 'none';
            }

            // Re-enable the add button if it was disabled
            var addButton = document.getElementById('addPenulisBtn');
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
                document.getElementById('removePenulisBtn').style.display = 'none';
            }
        });

        $(document).ready(function() {
            $('#instansi, #fakultas, #kategori, #rak').select2({
                width: 'resolve' // Pastikan lebar sesuai kontainer
            });
        });
        </script>
    </body>
</html>
