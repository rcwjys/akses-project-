<?php
require '../config/connection.php';

session_start();


if (!$_SESSION['login']) {
    header("Location: ../index.php");
} else {
    if (!$_SESSION['isCanViewDetail']) {
        header("Location: ../employee/persediaan-obat.php");
    }
}

$medicineId = mysqli_real_escape_string($conn, $_GET['medicineId']);

$sql = "SELECT * FROM medicines med
    INNER JOIN medicinerecipes mr ON mr.recipeId = med.recipeId
    INNER JOIN medicineunits mu ON med.medicineUnitId = mu.medicineUnitId
    INNER JOIN therapyclasses tc on med.therapyClassId = tc.therapyClassId
    INNER JOIN subtherapyclasses stc on med.subTherapyClassId = stc.subTherapyClassId
    WHERE med.medicineId = '$medicineId'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $medicine = mysqli_fetch_assoc($result);
} else {
    header("Location: ../employee/404.php");
}

if (isset($_POST['del-btn'])) {
    $sql = "DELETE FROM medicines where medicineId ='$medicineId'";
    $results = mysqli_query($conn, $sql);
    header("Location: ../employee/persediaan-obat.php");
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

    <title>Detail Obat <?php echo htmlspecialchars($medicine['medicineName']) ?> | UPTD Puskesmas Babakan Tarogong</title>


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
                <h6>Detail Obat</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 40vw;">Nama Obat </th>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($medicine['medicineName']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Stok Obat Tersisa</th>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($medicine['medicineStock']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Informasi</th>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($medicine['medicineInformation']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Waktu Exipired</th>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($medicine['expiredDate']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Periode Obat</th>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($medicine['medicinePeriod']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Resep Obat</th>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($medicine['recipe']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Kelas Terapi</th>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($medicine['therapyClassName']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Sub Kelas Terapi</th>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($medicine['subTherapyClassName']) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Satuan Obat</th>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($medicine['medicineUnit']) ?></td>
                        </tr>
                    </tbody>
                </table>
                <form action="" method="POST">
                    <a type="button" class="btn mt-5 mx-3 my-3 back-btn" href="../employee/persediaan-obat.php">Kembali</a>

                    <a class="btn btn-warning mt-4 submit-button edit-button" href="../employee/edit-data-obat.php?medicineId=<?php echo $medicine['medicineId'] ?>" name="edit-btn">Edit Data Obat</a>

                    <button class="btn btn-danger mt-4 delete-button ml-3" onclick="confirm('Apakah anda yakin ingin menghapus data ini?')" name="del-btn">Hapus Data Obat</button>
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