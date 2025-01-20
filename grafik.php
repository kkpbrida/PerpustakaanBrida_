<?php
require 'function.php';
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
            scales: {
                y: {
                    beginAtZero: true
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
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Penelitian</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .chart-container {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="chart-container">
            <h2 class="text-center">Bar Chart - Penelitian per Tahun</h2>
            <canvas id="myBarChart"></canvas>
        </div>
        <div class="chart-container">
            <h2 class="text-center">Pie Chart - Penelitian per Kategori</h2>
            <canvas id="myPieChart"></canvas>
        </div>
        <div class="chart-container">
            <h2 class="text-center">Line Chart - Penelitian per Fakultas</h2>
            <canvas id="myAreaChart"></canvas>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>