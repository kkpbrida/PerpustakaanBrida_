<?php
require 'function.php';// Ensure this file contains the database connection code
// Fetch data for Bar Chart (Penelitian per Tahun)
$barChartQuery = "SELECT tahun, COUNT(*) as jumlah FROM penelitian GROUP BY tahun";
$barChartResult = mysqli_query($conn, $barChartQuery);
$barChartData = [];
while ($row = mysqli_fetch_assoc($barChartResult)) {
    $barChartData[] = $row;
}

// Fetch data for Pie Chart (Penelitian per Kategori)
$pieChartQuery = "SELECT kategori.nama_kategori, COUNT(*) as jumlah FROM penelitian 
                  JOIN kategori ON penelitian.id_kategori = kategori.id_kategori 
                  GROUP BY penelitian.id_kategori";
$pieChartResult = mysqli_query($conn, $pieChartQuery);
$pieChartData = [];
while ($row = mysqli_fetch_assoc($pieChartResult)) {
    $pieChartData[] = $row;
}

// Fetch data for Line Chart (Penelitian per Fakultas)
$lineChartQuery = "SELECT fakultas.nama_fakultas, COUNT(*) as jumlah FROM penelitian 
                   JOIN fakultas ON penelitian.id_fakultas = fakultas.id_fakultas 
                   GROUP BY penelitian.id_fakultas";
$lineChartResult = mysqli_query($conn, $lineChartQuery);
$lineChartData = [];
while ($row = mysqli_fetch_assoc($lineChartResult)) {
    $lineChartData[] = $row;
}
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
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" >SIAP BRIDA</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <div class="navbar-right ms-auto">
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        
                        <!-- Bar Chart Section -->
                        <div class="chart-container mb-5">
                            <h2 class="text-center">Bar Chart - Penelitian per Tahun</h2>
                            <canvas id="myBarChart" style="width: 100%; max-height: 400px;"></canvas>
                        </div>
                        
                        <!-- Pie and Line Charts Row -->
                        <div class="row mt-5">
                            <!-- Pie Chart Column -->
                            <div class="col-md-6">
                                <div class="chart-container" style="position: relative; height: 400px;">
                                    <h2 class="text-center">Pie Chart - Penelitian per Kategori</h2>
                                    <canvas id="myPieChart"></canvas>
                                </div>
                            </div>
                            
                            <!-- Line Chart Column -->
                            <div class="col-md-6">
                                <div class="chart-container" style="position: relative; height: 400px;">
                                    <h2 class="text-center">Line Chart - Penelitian per Fakultas</h2>
                                    <canvas id="myAreaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                    .chart-container {
                        padding: 20px;
                        background: white;
                        border-radius: 8px;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    }

                    .row {
                        margin-right: -15px;
                        margin-left: -15px;
                    }

                    .col-md-6 {
                        padding: 15px;
                    }

                    canvas {
                        margin: 0 auto;
                    }
                    </style>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Bar Chart
                            var ctxBar = document.getElementById('myBarChart').getContext('2d');
                            var barChart = new Chart(ctxBar, {
                                type: 'bar',
                                data: {
                                    labels: <?php echo json_encode(array_column($barChartData, 'tahun')); ?>,
                                    datasets: [{
                                        label: 'Jumlah Penelitian',
                                        data: <?php echo json_encode(array_column($barChartData, 'jumlah')); ?>,
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: true, // Menjaga rasio aspek agar grafik tidak terlalu stretch
                                    aspectRatio: 2,           // Rasio aspek grafik (lebar/tinggi)
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                stepSize: 5  // Rentang sumbu Y dengan kelipatan 5
                                            }
                                        }
                                    },
                                    plugins: {
                                        legend: {
                                            position: 'top' // Posisi legenda di atas grafik
                                        }
                                    }
                                }
                            });

                            // Pie Chart
                            var ctxPie = document.getElementById('myPieChart').getContext('2d');
                            var pieChart = new Chart(ctxPie, {
                                type: 'pie',
                                data: {
                                    labels: <?php echo json_encode(array_column($pieChartData, 'nama_kategori')); ?>,
                                    datasets: [{
                                        data: <?php echo json_encode(array_column($pieChartData, 'jumlah')); ?>,
                                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                }
                            });

                            // Line Chart
                            var ctxLine = document.getElementById('myAreaChart').getContext('2d');
                            var lineChart = new Chart(ctxLine, {
                                type: 'line',
                                data: {
                                    labels: <?php echo json_encode(array_column($lineChartData, 'nama_fakultas')); ?>,
                                    datasets: [{
                                        label: 'Jumlah Penelitian',
                                        data: <?php echo json_encode(array_column($lineChartData, 'jumlah')); ?>,
                                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                        borderColor: 'rgba(153, 102, 255, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                    <div class="card mb-4">
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
    <script src="js/scripts.js"></script>
    <script>
    </script>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>