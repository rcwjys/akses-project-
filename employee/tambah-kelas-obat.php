<?php
session_start();

require '../config/connection.php';

if (!$_SESSION['login']) {
    header("Location: ../index.php");
}

$datas = mysqli_query($conn, "SELECT therapyClassId FROM therapyclasses");

if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['therapyClassId']);
    $therapyClassName =  mysqli_real_escape_string($conn, $_POST['therapyClassName']);

    $results = mysqli_query($conn, "INSERT INTO therapyclasses(therapyClassId, therapyClassName) VALUES ($id, '$therapyClassName')");

    header("Location: ../employee/kelas-obat.php");

    if (!$results) {
        echo "Error:" . " " . mysqli_error($conn);
    }
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

    <title>Kelas Obat| UPTD Puskesmas Babakan Tarogong</title>

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
<div class="container mt-5">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">ID Kelas Terapi</label>
                <input type="number" name="therapyClassId" class="form-control" id="inputEmail4" value="<?php echo mysqli_num_rows($datas) + 1 ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Nama Kelas Terapi</label>
                <input type="text" name="therapyClassName" class="form-control" id="inputPassword4" placeholder="Nama Kelas Terapi">
            </div>
        </div>
        <a href="../employee/kelas-obat.php" class="btn btn-primary back-btn">Kembali</a>

        <button type="submit" name="submit" class="btn btn-primary submit-button ml-3">Tambah</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<!-- custom js -->
<script src="../js/custom.js"></script>

<!-- footer section -->
<?php include("../employee/template/footer.php"); ?>
<!-- footer section -->