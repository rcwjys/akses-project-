<?php
require '../config/connection.php';

session_start();

if (!$_SESSION['login']) {
    header("Location: ../index.php");
}

$medicineRecipes = "SELECT * FROM medicinerecipes";

$results = mysqli_query($conn, $medicineRecipes);

if (mysqli_num_rows($results) >=     1) {
    $recipes = mysqli_fetch_all($results, MYSQLI_ASSOC);
} else {
    $_SESSION['medicineRecipeMessage'] = 'Resep Obat Tidak Ditemukan';
}

$medicineUnits = "SELECT * FROM medicineunits";

$medicineUnitResults = mysqli_query($conn, $medicineUnits);

if (mysqli_num_rows($medicineUnitResults) >= 1) {
    $units = mysqli_fetch_all($medicineUnitResults, MYSQLI_ASSOC);
} else {
    $_SESSION['medicineUnitsMessage'] = 'Satuan obat tidak ditemukan';
}

$therapyClass = mysqli_query($conn, "SELECT * FROM therapyClasses ORDER BY therapyClassName DESC");

if (mysqli_num_rows($therapyClass) >= 1) {
    $therapyclasses = mysqli_fetch_all($therapyClass, MYSQLI_ASSOC);
} else {
    $_SESSION['medicineUnitsMessage'] = 'Satuan obat tidak ditemukan';
}


$subClassTherapyClasses = mysqli_query($conn, "SELECT * FROM subtherapyclasses ORDER BY subTherapyClassName DESC");

if (mysqli_num_rows($subClassTherapyClasses) >= 1) {
    $subClassTherapyClass = mysqli_fetch_all($subClassTherapyClasses, MYSQLI_ASSOC);
} else {
    $_SESSION['medicineUnitsMessage'] = 'Satuan obat tidak ditemukan';
}

if (isset($_POST['addMedicine'])) {
    $medicineName = mysqli_real_escape_string($conn, $_POST['medicineName']);
    $medicineStock = mysqli_real_escape_string($conn, $_POST['medicineStock']);
    $medicineInformation = mysqli_real_escape_string($conn, $_POST['medicineInformation']);
    $expiredDate = mysqli_real_escape_string($conn, $_POST['expiredDate']);
    $medicinePeriod = mysqli_real_escape_string($conn, $_POST['medicinePeriod']);
    $medicineRecipe = mysqli_real_escape_string($conn, $_POST['medicineRecipe']);
    $classTherapy = mysqli_real_escape_string($conn, $_POST['classTherapy']);
    $subClassTherapy = mysqli_real_escape_string($conn, $_POST['subClassTherapy']);
    $medicineUnit = mysqli_real_escape_string($conn, $_POST['medicineUnit']);

    $sql = "SELECT * FROM medicines WHERE medicineName = '$medicineName'";

    $results = mysqli_query($conn, $sql);


    if (mysqli_num_rows($results) !== 1) {
        $sql = "INSERT INTO medicines (medicineName, medicineStock, medicineInformation, expiredDate, medicinePeriod, recipeId, therapyClassId, medicineUnitId, subTherapyClassId) VALUES ('$medicineName',$medicineStock,'$medicineInformation','$expiredDate','$medicinePeriod',$medicineRecipe, $classTherapy,$medicineUnit,$subClassTherapy)";
        var_dump($sql);

        $results = mysqli_query($conn, $sql);

        if ($results) {

            $_SESSION['addMedicineSuccessMessage'] = 'Data obat berhasil ditambahkan';
            header("Location: ../employee/persediaan-obat.php");
        } else {
            echo htmlspecialchars("Error" . mysqli_error($conn));
        }
    } else {
        $_SESSION['medicineErrorMessage'] = 'Data obat sudah terdaftar';
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

    <title>Tambah Data Persediaan Obat | UPTD Puskesmas Babakan Tarogong</title>


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
    <div class="card">
        <div class="card-header">
            Tambah Data Persediaan Obat
        </div>
        <form action="" method="POST" class="px-5 py-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Obat</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="medicineName">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Stok Obat</label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="medicineStock">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Keterangan Obat</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="medicineInformation">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Expired</label>
                <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="expiredDate">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Ketahanan Obat</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="medicinePeriod">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Resep Obat</label>
                <select class="form-control" name="medicineRecipe">
                    <option value="" selected>Resep Obat</option>
                    <?php foreach ($recipes as $recipe) : ?>
                        <option value="<?php echo htmlspecialchars($recipe['recipeId']) ?>"><?php echo htmlspecialchars($recipe['recipe']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Kelas Terapi</label>
                <select class="form-control" name="classTherapy">
                    <option value="" selected>Kelas Terapi</option>
                    <?php foreach ($therapyclasses as $therapy) : ?>
                        <option value="<?php echo htmlspecialchars($therapy['therapyClassId']) ?>"><?php echo htmlspecialchars($therapy['therapyClassName']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Sub Kelas Terapi</label>
                <select class="form-control" name="subClassTherapy">
                    <option value="" selected>Sub Kelas Terapi</option>
                    <?php foreach ($subClassTherapyClass as $subTherapy) : ?>
                        <option value="<?php echo htmlspecialchars($subTherapy['subTherapyClassId']) ?>"><?php echo htmlspecialchars($subTherapy['subTherapyClassName']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Satuan</label>
                <select class="form-control" name="medicineUnit">
                    <option value="" selected>Satuan Obat</option>
                    <?php foreach ($units as $unit) : ?>
                        <option value="<?php echo htmlspecialchars($unit['medicineUnitId']) ?>"><?php echo htmlspecialchars($unit['medicineUnit']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <a href="../employee/persediaan-obat.php" class="btn btn-primary mt-5 mr-3 back-btn">Kembali</a>

            <button type="submit" name="addMedicine" class="btn btn btn-primary submit-button mt-5">Tambah Data</button>
        </form>
    </div>
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