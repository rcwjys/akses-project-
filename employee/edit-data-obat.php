<?php 
    require '../config/connection.php';

    session_start();

    if (!$_SESSION['login']) {
        header("Location: ../index.php");
    }

    $medicineId = mysqli_real_escape_string($conn,$_GET['medicineId']);

    $sql = "SELECT * FROM medicines med
    INNER JOIN medicinerecipes mr ON mr.recipeId = med.recipeId
    INNER JOIN medicineunits mu ON med.medicineUnitId = mu.medicineUnitId
    INNER JOIN therapyclasses tc on med.therapyClassId = tc.therapyClassId
    INNER JOIN subtherapyclasses stc on med.subTherapyClassId = stc.subTherapyClassId
    WHERE med.medicineId = '$medicineId'";

    $medicineRecipesQuery = "SELECT * FROM medicinerecipes";
    $medicineUnitsQuery = "SELECT * FROM medicineunits";
    $subtherapyclassesQuery = "SELECT * FROM subtherapyclasses";
    $therapyclassesQuery = "SELECT * FROM therapyclasses";

    $medicineRecipesResults = mysqli_query($conn, $medicineRecipesQuery);
    $medicineUnitsResults = mysqli_query($conn, $medicineUnitsQuery);
    $subtherapyclassesResults = mysqli_query($conn, $subtherapyclassesQuery);
    $therapyclassesResults = mysqli_query($conn, $therapyclassesQuery);

    $medicineRecipes = mysqli_fetch_all($medicineRecipesResults, MYSQLI_ASSOC);
    $medicineUnits = mysqli_fetch_all($medicineUnitsResults, MYSQLI_ASSOC);
    $subtherapyclasses = mysqli_fetch_all($subtherapyclassesResults, MYSQLI_ASSOC);
    $therapyclasses = mysqli_fetch_all($therapyclassesResults, MYSQLI_ASSOC);


    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $medicine = mysqli_fetch_assoc($result);

    } else {
        header("Location: ../employee/404.php");
    }


    if (isset($_POST['edit-btn'])) {

        $medicineName = mysqli_real_escape_string($conn, $_POST['medicineName']);
        $medicineStock = mysqli_real_escape_string($conn, $_POST['medicineStock']);
        $medicineInformation = mysqli_real_escape_string($conn, $_POST['medicineInformation']);
        $expiredDate = mysqli_real_escape_string($conn, $_POST['expiredDate']);
        $medicinePeriod = mysqli_real_escape_string($conn, $_POST['medicinePeriod']);
        $medicineRecipe = mysqli_real_escape_string($conn, $_POST['medicineRecipe']);
        $classTherapy = mysqli_real_escape_string($conn, $_POST['classTherapy']);
        $subClassTherapy = mysqli_real_escape_string($conn, $_POST['subClassTherapy']);
        $medicineUnit = mysqli_real_escape_string($conn, $_POST['medicineUnit']);

        $sql = "UPDATE medicines SET medicineName='$medicineName', medicineStock=$medicineStock, medicineInformation = '$medicineInformation', expiredDate = '$expiredDate', medicinePeriod = '$medicinePeriod', recipeId = $medicineRecipe, therapyClassId = $classTherapy, subTherapyClassId = $subClassTherapy, 	medicineUnitId = $medicineUnit WHERE medicineId=$medicineId";

        $results = mysqli_query($conn, $sql);

        if ($results) {
            header("Location: ../employee/detail-obat.php?medicineId=$medicineId");
        } else {
            echo "Error:" . mysqli_error($conn);
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

  <title>Edit Detail Obat | UPTD Puskesmas Babakan Tarogong</title>

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
    <div class="card mx-auto" style="width: 60vw;">
        <div class="card-header text-center">
            <h6>Edit Detail Obat</h6>
        </div>
        <form action="" method="POST">
            <div class="row mt-5 px-5">
                <div class="col">
                    <label for="exampleInputEmail1">Nama Obat</label>
                    <input type="text" name="medicineName" class="form-control" id="exampleInputEmail1" aria-label="First name" value="<?php echo htmlspecialchars($medicine['medicineName']) ?>">
                </div>
                <div class="col">
                    <label for="exampleInputEmail1">Stok Obat</label>
                    <input type="number" name="medicineStock" class="form-control" id="exampleInputEmail1" aria-label="First name" value="<?php echo htmlspecialchars($medicine['medicineStock']) ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="exampleInputEmail1">Keterangan Obat</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="medicineInformation" value="<?php echo htmlspecialchars($medicine['medicineInformation']) ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Expired</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="expiredDate" value="<?php echo htmlspecialchars($medicine['expiredDate']) ?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Ketahanan Obat</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="medicinePeriod" value="<?php echo htmlspecialchars($medicine['medicinePeriod']) ?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Resep Obat</label>
                    <select class="form-control" name="medicineRecipe">
                        <option disabled value="<?php echo htmlspecialchars($medicine['recipeId']) ?>"><?php echo htmlspecialchars($medicine['recipe']) ?></option>
                        <?php foreach($medicineRecipes as $medicineRecipe):?>
                            <option value="<?php echo $medicineRecipe['recipeId'] ?>"><?php echo $medicineRecipe['recipe'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Kelas Terapi</label>
                    <select class="form-control" name="classTherapy">
                        <option disabled value="<?php echo htmlspecialchars($medicine['therapyClassId']) ?>"><?php echo htmlspecialchars($medicine['therapyClassName']) ?></option>
                        <?php foreach($therapyclasses as $therapyclass):?>
                            <option value="<?php echo $therapyclass['therapyClassId'] ?>"><?php echo $therapyclass['therapyClassName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Sub Kelas Terapi</label>
                    <select class="form-control" name="subClassTherapy">
                        <option value="<?php echo htmlspecialchars($medicine['subTherapyClassId']) ?>" disabled="disabled"><?php echo htmlspecialchars($medicine['subTherapyClassName']) ?></option>
                        <?php foreach($subtherapyclasses as $subtherapyclass):?>
                            <option value="<?php echo $subtherapyclass['subTherapyClassId'] ?>"><?php echo $subtherapyclass['subTherapyClassName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Satuan</label>
                    <select class="form-control" name="medicineUnit">
                        <option value="<?php echo htmlspecialchars($medicine['medicineUnitId']) ?>" disabled="disabled"><?php echo htmlspecialchars($medicine['medicineUnit']) ?></option>
                        <?php foreach($medicineUnits as $medicineUnit):?>
                            <option value="<?php echo $medicineUnit['medicineUnitId'] ?>"><?php echo $medicineUnit['medicineUnit'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
                <a type="button" class="btn mt-5 ml-5 my-3 back-btn" href="../employee/detail-obat.php?medicineId=<?php echo $medicineId?>">Kembali</a>

                <button class="btn btn-warning mt-4 ml-3 submit-button edit-button" name="edit-btn">Edit</button>


            </form>
        </div>
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