<?php 
  require("../config/connection.php");

  session_start();

  if (isset($_SESSION['login'])) {
    
  } else {
    header("Location: ../index.php");
  }

  $errorMessage = ['employeeName' => '', 'employeeEmail' => '', 'employeePhoneNumber' => '', 'employeeAddress' => '', 'employeePassword' => '', 'passwordConfirmation' => '', 'notEqualPassword' => ''];

  function validateForm() {
    
  }

  if (isset($_POST['register'])) {
    $employeeName = mysqli_real_escape_string($conn, $_POST['name']);
    $employeeEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $employeePhoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $employeeAddress = mysqli_real_escape_string($conn, $_POST['address']);
    $employeePassword = mysqli_real_escape_string($conn, $_POST['password']);
    $passConfirmation = mysqli_real_escape_string($conn, $_POST['passwordConfirmation']);
    

    if (empty($employeeName)) {
        $errorMessage['employeeName'] = "Nama karyawan tidak boleh kosong" ;
    }

    if (empty($employeeEmail)) {
        $errorMessage['employeeEmail'] = "Email karyawan tidak boleh kosong";
    } else {
        if (!filter_var($employeeEmail, FILTER_VALIDATE_EMAIL)) {
            $errorMessage['employeeEmail'] = "Email karyawan yang digunakan tidak valid";
          }
    }

    if (empty($employeePhoneNumber)) {
        $errorMessage['employeePhoneNumber'] = "No telepon karyawan tidak boleh kosong";
    } else {
        if (!preg_match("/^[0-9]+$/", $employeePhoneNumber)) {
            $errorMessage['phoneNumber'] = "No telepon karyawan harus berisi angka";
        }else {
            if (!preg_match("/^\d{12,}$/", $employeePhoneNumber)) {
                $errorMessage['phoneNumber'] = "No Telepon karyawan minimal memiliki 12 digit angka";
            }
        }
    }

    if (empty($employeeAddress)) {
        $errorMessage['employeeAddress'] = "Alamat karyawan tidak boleh kosong";
    }

    if (empty($employeePassword)) {
        $errorMessage['employeePassword'] = "Password tidak boleh kosong";
    } 

    if (empty($passConfirmation)) {
        $errorMessage['passwordConfirmation'] = "Konfirmasi password tidak boleh kosong";
    }

    if ($employeePassword !== $passConfirmation) {
        $errorMessage['notEqualPassword'] = 'Password dan password confirmation harus sama';
    } else {
        $sql = "SELECT * FROM employees WHERE employeeEmail = '$employeeEmail'";
        $employee = mysqli_query($conn, $sql);
        if (mysqli_num_rows($employee) !== 1) {
            $encryptedPassword = password_hash($employeePassword, PASSWORD_DEFAULT);

            $sql = "INSERT INTO employees (employeeName, employeeEmail, employeePhone, employeeAddress, isAdmin, employeePassword) VALUES ('$employeeName', '$employeeEmail', '$employeePhoneNumber', '$employeeAddress', 0, '$encryptedPassword') ";
            
            $results = mysqli_query($conn, $sql);
    
            if (!$results) {
                echo "error:".mysqli_error($conn);
            }
            header("Location: ".$_SERVER['PHP_SELF']);
        }
    }
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

  <title>Register | UPTD Puskesmas Babakan Tarogong</title>


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
                    <h2 class="text-center mb-5">Register</h2>
                    
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="username">Nama Pegawai</label>
                            <input type="text" name="name" class="form-control" id="username">
                            <p class="text-danger"><?php echo $errorMessage['employeeName']?></p>
                        </div>
                        <div class="form-group">
                            <label for="username">Email Pegawai</label>
                            <input type="text" name="email" class="form-control" id="username">
                            <p class="text-danger"><?php echo $errorMessage['employeeEmail']?></p>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">No Telepon Pegawai</label>
                            <input type="text" name="phoneNumber" class="form-control" id="password">
                            <p class="text-danger"><?php echo $errorMessage['employeePhoneNumber']?></p>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Alamat Pegawai</label>
                            <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"></textarea>
                            <p class="text-danger"><?php echo $errorMessage['employeeAddress']?></p>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                            <p class="text-danger"><?php echo $errorMessage['employeePassword']?></p>
                        </div>

                        <div class="form-group">
                            <label for="password">Konfirmasi Password</label>
                            <input type="password" name="passwordConfirmation" class="form-control" id="password">
                            <p class="text-danger"><?php echo $errorMessage['passwordConfirmation']?></p>
                        </div>

                        <div class="form-group text-left">
                            <p class="text-danger"><?php echo $errorMessage['notEqualPassword']?></p>
                        </div>

                        <div class="form-group text-right">
                            <a href="../employee/index.php" class="back-link">Kembali</a>
                        </div>
                        
                        <button type="submit" name="register" class="btn btn-block login-btn">Register</button>
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




