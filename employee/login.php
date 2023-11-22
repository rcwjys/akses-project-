<?php 
  require('../config/connection.php');

  session_start();

  if (isset($_SESSION['login'])) {
    header("Location: ../employee/index.php");
  }

  $errorMessage = ['email' => '', 'password' => '', 'credentials' => ''];
 
  if (isset($_POST['login'])) {
      $custEmail = mysqli_real_escape_string($conn, $_POST['email']);
      $custPassword = mysqli_real_escape_string($conn, $_POST['password']);


    if (empty($custEmail)) {
      $errorMessage['email'] = 'Email tidak boleh kosong';
    }else {
      if (!filter_var($custEmail, FILTER_VALIDATE_EMAIL)) {
        $errorMessage['email'] = "Email yang digunakan tidak valid";
      }
    }

    if (empty($custPassword)) {
      $errorMessage['password'] = 'Password tidak boleh kosong';
    } else {
      $sql = "SELECT * FROM employees WHERE employeeEmail = '$custEmail'";

      $results = mysqli_query($conn, $sql);

      if (mysqli_num_rows($results) === 1 ) {

        $employee = mysqli_fetch_assoc($results);

        if (password_verify($custPassword, $employee['employeePassword'])) {
          header("Location: ../employee/index.php");
          $_SESSION['login'] = true;
          $activeEmployee = $_SESSION['employeeName'] = $employee['employeeName'];
        } else {
          $errorMessage['credentials'] = 'Password salah';
        }
      } else {
        $errorMessage['credentials'] = 'Email tidak terdaftar';
      }

    }

    mysqli_free_result($results);
    mysqli_close($conn);

  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Login | UPTD Puskesmas Babakan Tarogong</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--Import Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- nice select -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
  <!-- datepicker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../css/responsive.css" rel="stylesheet" />
</head>

<style>
    body {
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background-color: #f8f9fa; /* Optional background color */
    }

    .login-container {
      max-width: 800px;
    }

    .login-btn {
      background-color: #019F90;
      color: #fff;
    }

    .login-btn {
      background-color: #019F90;
      color: #fff;
      transition: transform 0.3s;
    }

    .login-btn:hover {
      transform: scale(1.02);
      color: #fff; /* Resetting text color on hover */
      background-color: #019F90; /* Resetting background color on hover */
      box-shadow: none; /* Resetting box-shadow on hover */
    }

    .footer_section {
        background-color: #f8f9fa;
    }

    a.back-link {
        color: #019F90;
    }
  </style>
</head>
<body>  
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-container">
                    <h2 class="text-center mb-5">Login</h2>
                    
                    <form action="" method="POST">
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="email" name="email" class="form-control" id="username">
                        <p class="text-danger mt-1"><?php echo $errorMessage['email']?></p>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                        <p class="text-danger mt-1"><?php echo $errorMessage['password']?></p>
                    </div>

                    <div class="form-group">
                        <p class="text-danger mt-1"><?php echo $errorMessage['credentials']?></p>
                    </div>

                    <div class="form-group text-right">
                        <a href="../index.php" class="back-link">Kembali</a>
                    </div>
                    
                    <button type="submit" name="login" class="btn btn-block login-btn">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer_section fixed-bottom">
        <div class="container">
        <p>
            &copy; <?php echo date("Y"); ?> All Rights Reserved By Kelompok 4 SI4501
        </p>
        </div>
    </footer>

  <!-- jQery -->
  <script src="../js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="../js/bootstrap.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <!-- custom js -->
  <script src="../js/custom.js"></script>
  
  </body>
  </html>




