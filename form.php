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
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
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
        <!-- Navbar -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand ps-3">SIAP BRIDA</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        </nav>
        <!-- Sidenav -->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="form.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                                Tambah Penelitian
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tambah Penelitian</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="form.php" method="post">
                                    <div class="mb-3">
                                        <label for="tgl_masuk" class="form-label">Tanggal Registrasi:</label>
                                        <input type="date" id="tgl_masuk" name="tgl_masuk" class="form-control" required>
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
                                    <script>
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
                                    </script>
                                    <div class="mb-3">
                                        <label for="instansi" class="form-label">Instansi:</label>
                                        <div class="select-container">
                                            <select id="instansi" name="instansi" class="form-control" required>
                                                <option value="" disabled selected>Pilih Instansi</option>
                                                <?php
                                                    $getdata = mysqli_query($conn, "SELECT * FROM instansi");
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
                                            <i class="fa fa-caret-down"></i>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fakultas" class="form-label">Fakultas:</label>
                                        <div class="select-container">
                                            <select id="fakultas" name="fakultas" class="form-control" required>
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
                                        <label for="kategori" class="form-label">Kategori:</label>
                                        <div class="select-container">
                                            <select id="kategori" name="kategori" class="form-control" required>
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
                                        <label for="tahun" class="form-label">Tahun:</label>
                                        <div class="select-container">
                                            <select id="tahun" name="tahun" class="form-control" required>
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
                                        <label for="rak" class="form-label">Rak:</label>
                                        <div class="select-container">
                                            <select id="rak" name="rak" class="form-control" required>
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
                            <div class="text-muted">Copyright &copy; kkp ilkom nihh bozzz</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script>
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
        </script>
    </body>
</html>
