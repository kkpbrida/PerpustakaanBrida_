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
        header("location: dashboard.php");
        // exit();
    } else {
        $error = "Invalid username or password!";
    }
}

if (isset($_SESSION['login'])) {
    header("location: dashboard.php");
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
        <style>
            body {
                background: linear-gradient(rgba(0, 51, 102, 0.7), rgba(0, 51, 102, 0.7)), url('assets/img/9.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }
            
            .card {
                background-color: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
            }
            
            .btn-custom-primary {
                background-color: #FFC107;
                border-color: #FFC107;
                color: #000;
                transition: all 0.3s ease;
            }
            
            .btn-custom-primary:hover {
                background-color: #FFB300;
                border-color: #FFB300;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            
            .card-header {
                background-color: transparent;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                position: relative;
            }
            
            .card-footer {
                background-color: transparent;
                border-top: 1px solid rgba(0, 0, 0, 0.1);
            }

            .home-icon {
                color: #FFC107;
                position: absolute;
                top: 25%;
                right: 15px;
                transform: translateY(-50%);
            }
        </style>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                      <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Login</h3>
                                        <a href="home.php" class="home-icon"><i class="fas fa-home"></i></a>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="login.php">  
                                            <div class="form-floating mb-3 position-relative">
                                                <input class="form-control" id="inputUsername" type="text" placeholder="Username" name="username" required />
                                                <label for="inputUsername">Username</label>
                                            </div>
                                            <div class="form-floating mb-3 position-relative">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" required />
                                                <label for="inputPassword">Password</label>
                                                <span class="position-absolute top-50 end-0 translate-middle-y me-3" onclick="togglePassword()">
                                                    <i id="togglePasswordIcon" class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center text-center mt-4 mb-3">   
                                                <button class="btn btn-custom-primary px-4" name="login">Login</button>
                                            </div>
                                            <!-- <div class="d-flex align-items-center justify-content-center text-center">
                                                <a class="btn btn-custom-primary px-4" href="home.php">Back to Home</a>
                                            </div> -->
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

            // Toggle password visibility
            function togglePassword() {
                var passwordField = document.getElementById('inputPassword');
                var togglePasswordIcon = document.getElementById('togglePasswordIcon');
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    togglePasswordIcon.classList.remove('fa-eye');
                    togglePasswordIcon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    togglePasswordIcon.classList.remove('fa-eye-slash');
                    togglePasswordIcon.classList.add('fa-eye');
                }
            }
        </script>
    </body>
</html>
