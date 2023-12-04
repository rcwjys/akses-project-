<?php 
    session_start();

    require '../config/connection.php';

    if (!$_SESSION['login']) {
        header("Location: ../index.php");
    }

    $classtherapysResults = mysqli_query($conn, "SELECT * FROM therapyclasses ORDER BY therapyClassId");

    $subClasstherapysResults = mysqli_query($conn, "SELECT * FROM subtherapyclasses GROUP BY  subTherapyClassId, subTherapyClassName DESC");

    
    $classtherapys = mysqli_fetch_all($classtherapysResults, MYSQLI_ASSOC);
    $subClasstherapys = mysqli_fetch_all($subClasstherapysResults, MYSQLI_ASSOC);


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

  <title>Kelas Obat | UPTD Puskesmas Babakan Tarogong</title>
    
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
  
    <div class="row mt-5 gx-5">
       <div class="col-6 px-5 py-5">
            <div class="card-header text-center">
                <h5 class="mb-3">Kelas Obat</h5>
            </div>
            <table class="table table-striped">
                <tr>
                    <th scope="col">ID Kelas</th>
                    <th scope="col">Nama Kelas Obat</th>
                </tr>
                <?php foreach($classtherapys as $classtherapy) :?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($classtherapy['therapyClassId']) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($classtherapy['therapyClassName']) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                <a href="../employee/tambah-kelas-obat.php" class="btn btn-primary edit-button mb-3">Tambah Data Kelas obat</a>
            </table>
       </div>

       <div class="col-6 px-5 py-5">
            <div class="card-header text-center">
                <h5 class="mb-3">Sub Kelas Obat</h5>
            </div>
            <table class="table table-striped">
                <tr>
                    <th scope="col">ID Subkelas</th>
                    <th scope="col">Nama Subkelas Obat</th>
                    <th scope="col">Turunan dari Kelas</th>
                    
                </tr>
                <?php foreach($subClasstherapys as $subClasstherapy) :?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($subClasstherapy['subTherapyClassId']) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($subClasstherapy['subTherapyClassName']) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($subClasstherapy['therapyClassId']) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                <a href="../employee/tambah-sub-kelas.php" class="btn btn-primary edit-button mb-3">
                    Tambah Data sub-kelas Obat
                </a>
            </table>
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