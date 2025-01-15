<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>e-Library BRIDA</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container-fluid px-4">
            <h1 class="mt-4">SELAMAT DATANG DI SIAP BRIDA</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Buku
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                    </div>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Instansi</th>
                                <th>Fakultas</th>
                                <th>Tahun</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Judul</th>
                                <th>Instansi</th>
                                <th>Fakultas</th>
                                <th>Tahun</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Introduction to Algorithms</td>
                                <td>Universitas Halu Oleo</td>
                                <td>Kedokteran</td>
                                <td>2024</td>
                                <td>Selin Rahmadani</td>
                                <td>S1</td>
                            </tr>
                            <tr>
                                <td>Data Structures and Algorithms</td>
                                <td>Universitas Indonesia</td>
                                <td>Teknik</td>
                                <td>2023</td>
                                <td>Ahmad Fauzi</td>
                                <td>S2</td>
                            </tr>
                            <tr>
                                <td>Machine Learning</td>
                                <td>Universitas Gadjah Mada</td>
                                <td>Ilmu Komputer</td>
                                <td>2022</td>
                                <td>Rina Suryani</td>
                                <td>BRIDA</td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; kkp ilkom nihh bozzz</div>
                </div>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
