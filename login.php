<?php
require 'function.php';

//cek login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //cekking database
    $result = mysqli_query($conn, "SELECT * FROM login WHERE username = '$username' AND password = '$password'");
    //hitung jumlah data
    $cek = mysqli_num_rows($result);

    if ($cek > 0) {
        $_SESSION['login'] = true;
        header("location: index.php");
        // exit();
    } else {
        $error = "Invalid username or password!";
    }
}

if (isset($_SESSION['login'])) {
    header("location: index.php");
    // exit();
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
        <title>Login - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="login.php">  
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputUsername" type="text" placeholder="Username" name="username" required />
                                                <label for="inputUsername">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" required />
                                                <label for="inputPassword">Password</label>
                                            </div>  
                                            <div class="d-flex align-items-center justify-content-center text-center mt-4 mb-0">   
                                                <button class="btn btn-primary" name="login">Login</button>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center text-center mt-4 mb-0">
                                            <a class="btn btn-secondary" href="home.php">Go to Home</a>
                                            </div>
                                    </form>
                                    </div>
                                    <div class="card-footer text-center py-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Login Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Invalid username or password. Please try again.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script>
            // Show the modal if there's an error
            <?php if (isset($error)): ?>
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'), {});
                errorModal.show();
            <?php endif; ?>
        </script>
    </body>
</html>
