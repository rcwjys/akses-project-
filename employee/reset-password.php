<?php 
    require "../config/connection.php";
    session_start();

    if ($_SESSION['login']) {
        if (!$_SESSION['isEmployeeDetailProvided']) {
            header("Location: ../employee/404.php");
        }
    } else {
        header('Location: ../index.php');
    }

    $employeeId = (int)mysqli_real_escape_string($conn, $_GET['employeeId']);

    $fetchEmployee = mysqli_query($conn, "SELECT employeeId FROM employees WHERE employeeid=$employeeId");

    $employee = mysqli_fetch_assoc($fetchEmployee);

    if (mysqli_num_rows($fetchEmployee) !== 0) {
        if (isset($_POST['changePassword'])) {

            $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);

            $newPasswordConfirmation = mysqli_real_escape_string($conn, $_POST['newPasswordConfirmation']);
        
            if ($newPassword === $newPasswordConfirmation) {
                
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
                $updatePasswordStatement = "UPDATE employees SET employeePassword = '$hashedNewPassword' WHERE employeeId = $employeeId";

                $updatePassword = mysqli_query($conn, $updatePasswordStatement);

                $_SESSION['isPasswordValidationComplete'] = true;
                $_SESSION['passwordConfirmationMessage'] = "Password berhasil diupdate";

                header(`Location: echo {$_SERVER['PHP_SELF']} `);
            } else {
                $_SESSION['isPasswordValidationComplete'] = false;
                $_SESSION['passwordConfirmationMessage'] = "Password dan Password Confirmation tidak sama";
            }
        }
        
    } else {
        header("Location: ../employee/list-pegawai.php");
    }

?>

<!DOCTYPE html>
<html>
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

  <title>Reset Password Pegawai | UPTD Puskesmas Babakan Tarogong</title>


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
  <link href="../css/font-awesome.min.css" rel="stylesheet" />
  <!-- nice select -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
  <!-- datepicker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../css/responsive.css" rel="stylesheet" />
</head>

    <?php include("../employee/template/header.php") ?>

    <div class="container mt-5">
        <?php if(isset($_SESSION['passwordConfirmationMessage'])) : ?>
            <?php if($_SESSION['isPasswordValidationComplete']) :?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>
                    <?php echo $_SESSION['passwordConfirmationMessage'];?>
                    <?php unset($_SESSION['passwordConfirmationMessage']); ?>
                </strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php else:  ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>
                    <?php echo $_SESSION['passwordConfirmationMessage'];?>
                    <?php unset($_SESSION['passwordConfirmationMessage']); ?>
                </strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
        <?php endif; ?>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
            <div class="form-row g-5">
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password Baru</label>
                    <input type="password" name="newPassword" class="form-control" id="inputPassword4" placeholder="Password Baru">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Konfirmasi Password Baru</label>
                    <input type="password" name="newPasswordConfirmation" class="form-control" id="inputPassword4" placeholder="Konfirmasi Password Baru">
                </div>
            </div>

            <a  href="../employee/detail-pegawai.php?employeeId=<?php echo htmlspecialchars($employee['employeeId']) ?>" class="btn btn-primary back-btn">Kembali</a>

            <button type="submit" name="changePassword" class="btn btn-primary submit-button ml-3">Update</button>
        </form>
    </div>




  <!-- jQery -->
  <script src="../js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="../js/bootstrap.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- datepicker -->
  <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- custom js -->
  <script src="../js/custom.js"></script>
  

  <!-- footer section -->
  <?php include("../employee/template/footer.php"); ?>
  <!-- footer section -->
