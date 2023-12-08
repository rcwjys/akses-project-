<?php
// * Require Connection From Database   
require "../config/connection.php";

// * Start The Session   
session_start();

// * isUser has Login Session   
if ($_SESSION['login']) {
    if (!$_SESSION['isEmployeeDetailProvided']) {
        header("Location: ../employee/list-pegawai.php");
    }
} else {
    header('Location: ../index.php');
}

$employeeId = mysqli_real_escape_string($conn, $_GET['employeeId']);

$fetchEmployee = mysqli_query($conn, "SELECT * FROM employees where employeeid = $employeeId");

if (mysqli_num_rows($fetchEmployee) === 1) {
    $employee = mysqli_fetch_assoc($fetchEmployee);
} else {
    header("Location: ../employee/404.php");
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

    <title>Detail Pegawai | UPTD Puskesmas Babakan Tarogong</title>


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

<?php if ($_SESSION['isAdmin']) : ?>
    <?php include("../employee/template/header-admin.php") ?>
<?php else : ?>
    <?php include("../employee/template/header.php") ?>
<?php endif; ?>

<main>
    <div class="container mt-5">
        <div class="card mx-auto" style="width: 60vw;">
            <div class="card-header text-center">
                <h6>Detail Pegawai</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 40vw;">Nama Pegawai </th>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($employee['employeeName']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Email Pegawai</th>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($employee['employeeEmail']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">No Telepon Pegawai</th>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($employee['employeePhone']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat Pegawai</th>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($employee['employeeAddress']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Role</th>
                            <td>:</td>
                            <td>
                                <?php if ($employee['isAdmin'] == 1) : ?>
                                    <?php echo htmlspecialchars("Admin") ?>
                                <?php else : ?>
                                    <?php echo htmlspecialchars("Pegawai") ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <form action="" method="POST">
                    <a type="button" class="btn mt-5 mx-3 my-3 back-btn" href="../employee/list-pegawai.php">Kembali</a>

                    <a type="button" class="btn mt-5 mx-3 my-3 back-btn" href="../employee/reset-password.php?employeeId=<?php echo $employee['employeeId'] ?>">Reset Password</a>
                </form>
            </div>
        </div>
    </div>
</main>

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


<!-- footer section -->
<?php include("../employee/template/footer.php"); ?>
<!-- footer section -->