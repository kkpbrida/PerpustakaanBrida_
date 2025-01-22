<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan BRIDA - Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .custom-navbar {
            background-color: #003366 !important;
        }
        .custom-footer {
            background-color: #003366 !important;
        }
        .btn-interactive {
            background-color: #FFC107;
            color: black;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn-interactive:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .carousel-fade .carousel-item {
        transition: opacity 0.8s ease-in-out;
    }
    
    .carousel-indicators button {
        width: 12px !important;
        height: 12px !important;
        border-radius: 50% !important;
        margin: 0 8px !important;
        background-color: rgba(255, 255, 255, 0.5) !important;
        border: 2px solid rgba(255, 255, 255, 0.8) !important;
        transition: all 0.3s ease;
    }
    
    .carousel-indicators button.active {
        background-color: #FFC107 !important;
        transform: scale(1.2);
    }

    .btn-interactive {
        transition: all 0.3s ease;
        background-color: #FFC107;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-interactive:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        background-color: #FFD54F;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .carousel-item.active .position-absolute {
        animation: fadeInUp 0.8s ease-out;
    }

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
        <div class="container">
            <div class="d-flex align-items-center">
                <img src="assets/img/instansi-logo.png" alt="Logo BRIDA" height="40" class="me-2">
                <div>
                    <a class="navbar-brand" href="#">E-BRAY BRIDA</a>
                    <small class="d-block text-white">Electronic Library BRIDA Provinsi  Sulawesi Tenggara</small>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-lg btn-interactive" href="login.php" style="margin-top: -2px;">
                            <i class="fas fa-sign-in-alt me-2"></i>Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

        <!-- Hero Section dengan Carousel -->
    <div class="container-fluid p-0">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/6.jpg" class="d-block w-100" alt="Perpustakaan BRIDA 1" style="object-fit: cover; height: 600px;">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/7.jpg" class="d-block w-100" alt="Perpustakaan BRIDA 2" style="object-fit: cover; height: 600px;">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/8.jpg" class="d-block w-100" alt="Perpustakaan BRIDA 3" style="object-fit: cover; height: 600px;">
                </div>
            </div>
            
            <!-- Carousel Controls with enhanced styling -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 50%; padding: 20px;"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 50%; padding: 20px;"></span>
                <span class="visually-hidden">Next</span>
            </button>
            
            <!-- Enhanced Overlay Text with animation -->
            <div class="position-absolute top-50 start-50 translate-middle text-center text-white" style="z-index: 2; width: 80%;">
                <div class="bg-dark bg-opacity-25 p-4 rounded-lg">
                    <h1 class="display-4 fw-bold" style="color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
                        Perpustakaan BRIDA
                    </h1>
                    <p class="lead" style="color: white; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">
                        Pusat Penelitian dan Pengetahuan
                    </p>
                    <a href="depan.php" class="btn btn-lg mt-3 btn-interactive" style="backdrop-filter: blur(5px);">
                        <i class="fas fa-search me-2"></i>Cari Penelitian
                    </a>
                </div>
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
    <footer class="custom-footer text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <img src="assets/img/logo_sultra.png" alt="Logo Sultra" height="80" class="me-2">
                    <div>
                        <h5>E-BRAY BRIDA</h5>
                        <p>Electronic Library Badan Riset Inovasi Daerah</p>
                        <p>Provinsi Sulawesi Tenggara</p>
                        <p>Kendari</p>
                        <p>Jl. Mayjend S. Parman No. 3, Kemaraya</p>
                    </div>
                    <style>
                        .custom-footer p {
                            margin-bottom: 0.1rem;
                        }
                    </style>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>© KKP Ilmu Komputer UHO 2025.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>