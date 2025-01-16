<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan BRIDA - Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand mx-auto" href="#">SIAP BRIDA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section dengan Gambar -->
    <div class="container-fluid p-0">
        <div class="position-relative">
            <img src="assets\img\6.jpg" alt="Perpustakaan BRIDA" class="w-100" style="object-fit: cover; height: 400px;">
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
                <h1 class="display-4 fw-bold" style="color: black; background-color: rgba(255, 255, 255, 0.7); padding: 10px; border-radius: 5px;">Perpustakaan BRIDA</h1>
                <p class="lead" style="color: black; background-color: rgba(255, 255, 255, 0.7); padding: 5px; border-radius: 5px;">Pusat Penelitian dan Pengetahuan</p>
                <a href="depan.php" class="btn btn-primary btn-lg mt-3">
                    <i class="fas fa-search me-2"></i>Cari Penelitian
                </a>
            </div>
        </div>
    </div>

    <!-- Profil Singkat -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto text-center">
                    <h2 class="mb-4">Profil Singkat</h2>
                    <p class="lead">
                        Perpustakaan BRIDA merupakan pusat sumber belajar yang menyediakan berbagai koleksi buku, jurnal, dan sumber daya digital untuk mendukung kegiatan pembelajaran dan penelitian.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Visi</h3>
                            <p class="card-text">
                                Menjadi perpustakaan modern yang unggul dalam pelayanan dan penyediaan sumber informasi untuk mendukung kegiatan pembelajaran dan penelitian.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Misi</h3>
                            <ul class="card-text">
                                <li>Menyediakan sumber daya informasi yang berkualitas</li>
                                <li>Memberikan layanan prima kepada pengguna</li>
                                <li>Mengembangkan teknologi informasi perpustakaan</li>
                                <li>Membangun kerjasama dengan berbagai institusi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Perpustakaan -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Galeri Perpustakaan</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <img src="assets\img\land1.jpg" alt="Area Baca" class="img-fluid rounded">
                </div>
                <div class="col-md-4">
                    <img src="assets\img\land2.jpg" alt="Koleksi Buku" class="img-fluid rounded">
                </div>
                <div class="col-md-4">
                    <img src="assets\img\land3.jpg" alt="Ruang Diskusi" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>SIAP BRIDA</h5>
                    <p>Sistem Informasi Akademik Perpustakaan BRIDA</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>© 2025 SIAP BRIDA. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>