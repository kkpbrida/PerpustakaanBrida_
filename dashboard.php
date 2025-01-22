<?php

require 'function.php';
require 'cek.php';


// Fetch data for Bar Chart (Penelitian per Tahun) for the current year and the last 3 years
$currentYear = 2025;
$startYear = $currentYear - 3;

$barChartQuery = "SELECT tahun, COUNT(*) as jumlah FROM penelitian WHERE tahun BETWEEN $startYear AND $currentYear GROUP BY tahun";
$barChartResult = mysqli_query($conn, $barChartQuery);
$barChartData = [];
while ($row = mysqli_fetch_assoc($barChartResult)) {
    $barChartData[] = $row;
}

// Fetch data for Pie Chart (Penelitian per Kategori)
$pieChartQuery = "SELECT kategori.nama_kategori, COUNT(*) as jumlah FROM penelitian INNER JOIN kategori ON penelitian.id_kategori = kategori.id_kategori GROUP BY kategori.nama_kategori";
$pieChartResult = mysqli_query($conn, $pieChartQuery);
$pieChartData = [];
while ($row = mysqli_fetch_assoc($pieChartResult)) {
    $pieChartData[] = $row;
}

// Fetch total count of all Penelitian
$totalPenelitianQuery = "SELECT COUNT(*) as total FROM penelitian";
$totalPenelitianResult = mysqli_query($conn, $totalPenelitianQuery);
$totalPenelitianData = mysqli_fetch_assoc($totalPenelitianResult);
$totalPenelitian = $totalPenelitianData['total'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ebray - ADMIN</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- memuat jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <div style="margin-top: 56px;"></div> <!-- Batasan untuk menghindari overlap dengan navbar -->
        </nav>
            </div>
            <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Admin</li>
                </ol>
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                        PENELITIAN
                        <h2><?= $totalPenelitian; ?></h2>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                        </div>
                    </div>
                    </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">
                                        BRIDA
                                        <h2>
                                            <?php
                                            $bridaCount = 0;
                                            foreach ($pieChartData as $data) {
                                                if ($data['nama_kategori'] === 'BRIDA') {
                                                    $bridaCount = $data['jumlah'];
                                                    break;
                                                }
                                            }
                                            echo $bridaCount;
                                            ?>
                                        </h2>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">
                                        NON-BRIDA
                                        <h2>
                                            <?php
                                            $nonBridaCount = 0;
                                            foreach ($pieChartData as $data) {
                                                if ($data['nama_kategori'] !== 'BRIDA') {
                                                    $nonBridaCount += $data['jumlah'];
                                                }
                                            }
                                            echo $nonBridaCount;
                                            ?>
                                        </h2>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-pie me-1"></i>
                                        Pie Chart - Jumlah Penelitian per Kategori
                                    </div>
                                    <div class="card-body"><canvas id="pieChart" width="100%" height="50"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart - Jumlah Penelitian per Tahun
                                    </div>
                                    <div class="card-body"><canvas id="barChart" width="100%" height="50"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Latest Data
                            </div>
                            <div class="card-body">
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
                            <div class="text-muted">Copyright &copy; Kuliah Kerja Praktik Ilmu Komputer</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchTableData();

        function fetchTableData() {
            $.ajax({
                url: 'search.php',
                type: 'POST',
                dataType: 'json', // Pastikan tipe data yang diterima adalah JSON
                data: {
                    page_type: 'depan'
                },
                success: function(data) {
                    try {
                        $('#data-table tbody').html(data.data);
                        $('#pagination').html(data.pagination);
                        $('#data-info').html(data.info);
                    } catch (e) {
                        console.error("Parsing error:", e);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", status, error);
                }
            });
        }
    });

 // Data untuk Bar Chart
const barChartLabels = <?= json_encode(array_column($barChartData, 'tahun')); ?>;
const barChartData = <?= json_encode(array_column($barChartData, 'jumlah')); ?>;

const barCtx = document.getElementById('barChart').getContext('2d');
new Chart(barCtx, {
    type: 'line',
    data: {
        labels: barChartLabels,
        datasets: [{
            label: 'Jumlah Penelitian',
            data: barChartData,
            backgroundColor: 'rgba(54, 162, 235, 1)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            fill: false
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        responsive: true,
        plugins: {
            legend: { display: false }
        }
    }
});

// Data untuk Pie Chart
const pieChartLabels = <?= json_encode(array_column($pieChartData, 'nama_kategori')); ?>;
const pieChartData = <?= json_encode(array_column($pieChartData, 'jumlah')); ?>;

const pieCtx = document.getElementById('pieChart').getContext('2d');
new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: pieChartLabels,
        datasets: [{
            data: pieChartData,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ]
        }]
    },
    options: {
        responsive: true
    }
});

</script>
