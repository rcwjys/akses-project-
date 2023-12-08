<?php
session_start();

require '../config/connection.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
}

$sql = "SELECT * FROM medicines";

$results = mysqli_query($conn, $sql);

if ($results) {
    $medicines = mysqli_fetch_all($results, MYSQLI_ASSOC);
} else {
    echo "Error: " . mysqli_error($conn);
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

    <title>Persediaan Obat | UPTD Puskesmas Babakan Tarogong</title>


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
        <!-- Add Medicine Button -->
        <a href="../employee/tambah-data-obat.php" class="btn btn-primary mt-5 medicine-add-btn">+ Tambah data persediaan obat</a>

        <?php if ($medicines) : ?>
            <?php $_SESSION['isCanViewDetail'] = true; ?>
            <div class="row mt-5">
                <?php foreach ($medicines as $medicine) : ?>
                    <div class="col-lg-3">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo htmlspecialchars($medicine['medicineName']) ?>
                                </h5>
                                <a href="../employee/detail-obat.php?medicineId=<?php echo $medicine['medicineId'] ?>" class="card-link" style="color: #019F90;">Details
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <?php $_SESSION['isCanViewDetail'] = false; ?>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center">Maaf, data tidak tersedia</h3>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

.



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