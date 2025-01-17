<?php
require_once 'function.php';
// Query jumlah publikasi per tahun
$query = "SELECT Tahun, COUNT(*) AS JumlahPublikasi FROM Penelitian GROUP BY Tahun";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}


// Kirim data ke JavaScript dalam format JSON
$jsonData = json_encode($data)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Publikasi</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Grafik Jumlah Publikasi per Tahun</h1>
    <canvas id="myChart" width="400" height="200"></canvas>

    <script>
        // Ambil data dari PHP
        const dataFromPHP = <?php echo $jsonData; ?>;

        // Format data untuk Chart.js
        const labels = dataFromPHP.map(item => item.Tahun);
        const data = dataFromPHP.map(item => item.JumlahPublikasi);

        // Konfigurasi Chart.js
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // Jenis grafik: bar, line, pie, dll
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Publikasi',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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
    </script>
</body>
</html>
<?php
// Query jumlah publikasi per kategori
$queryKategori = "SELECT kategori.nama_kategori, COUNT(penelitian.id_penelitian) AS jumlah_penelitian FROM penelitian JOIN kategori  ON penelitian.id_kategori = kategori.id_kategori GROUP BY kategori.nama_kategori;";
$resultKategori = $conn->query($queryKategori);

$dataKategori = [];
while ($rowKategori = $resultKategori->fetch_assoc()) {
    $dataKategori[] = $rowKategori;
}

$conn->close();

// Kirim data ke JavaScript dalam format JSON
$jsonDataKategori = json_encode($dataKategori);
?>

<script>
    // Ambil data dari PHP
    const dataKategoriFromPHP = <?php echo $jsonDataKategori; ?>;

    // Format data untuk Chart.js
    const labelsKategori = dataKategoriFromPHP.map(item => item.Kategori);
    const dataKategori = dataKategoriFromPHP.map(item => item.JumlahPublikasi);

    // Konfigurasi Chart.js untuk pie chart
    const ctxKategori = document.getElementById('myPieChart').getContext('2d');
    const myPieChart = new Chart(ctxKategori, {
        type: 'pie', // Jenis grafik: pie
        data: {
            labels: labelsKategori,
            datasets: [{
                label: 'Jumlah Publikasi per Kategori',
                data: dataKategori,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
</script>

<canvas id="myPieChart" width="400" height="200"></canvas>
