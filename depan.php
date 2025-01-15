<?php
// // Query pencarian
// $search_type = isset($_GET['search_type']) ? $_GET['search_type'] : 'judul';
// $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
// $entries_per_page = isset($_GET['entries']) ? $_GET['entries'] : 10;

// $where_clause = "";
// if (!empty($search_query)) {
//     $search_query = mysqli_real_escape_string($conn, $search_query);
//     $where_clause = "WHERE $search_type LIKE '%$search_query%'";
// }

// $query = "SELECT * FROM buku $where_clause ORDER BY judul ASC";
// $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Buku Perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .search-container {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }
        select, input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="text"] {
            flex-grow: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 5px;
        }
        .pagination a {
            padding: 8px 12px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: black;
            border-radius: 4px;
        }
        .pagination a.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        .entries-container {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pencarian Buku Perpustakaan</h2>
        
        <form method="GET" action="" class="search-container">
            <select name="search_type">
                <option value="judul" <?php echo $search_type == 'judul' ? 'selected' : ''; ?>>Judul Buku</option>
                <option value="instansi" <?php echo $search_type == 'instansi' ? 'selected' : ''; ?>>Instansi</option>
                <option value="penulis" <?php echo $search_type == 'penulis' ? 'selected' : ''; ?>>Penulis</option>
            </select>
            <input type="text" name="search_query" placeholder="Masukkan kata kunci pencarian..." 
                   value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit">Cari</button>
        </form>

        <div class="entries-container">
            <select name="entries" onchange="this.form.submit()">
                <option value="10" <?php echo $entries_per_page == 10 ? 'selected' : ''; ?>>10</option>
                <option value="25" <?php echo $entries_per_page == 25 ? 'selected' : ''; ?>>25</option>
                <option value="50" <?php echo $entries_per_page == 50 ? 'selected' : ''; ?>>50</option>
                <option value="100" <?php echo $entries_per_page == 100 ? 'selected' : ''; ?>>100</option>
            </select>
            entries per page
        </div>

        <table>
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Instansi</th>
                    <th>Fakultas</th>
                    <th>Tahun</th>
                    <th>Penulis</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['judul']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['instansi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fakultas']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tahun']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['penulis']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align: center;'>Tidak ada data yang ditemukan</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php
            // Tambahkan pagination sesuai kebutuhan
            for ($i = 1; $i <= 5; $i++) {
                echo "<a href='#' " . ($i == 1 ? "class='active'" : "") . ">$i</a>";
            }
            ?>
        </div>
    </div>
</body>
</html>