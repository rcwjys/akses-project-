<?php 
    session_start();

    require '../config/connection.php';

    if (!$_SESSION['login']) {
        header("Location: ../index.php");
    }

    $ClassData = mysqli_query($conn, "SELECT * FROM therapyclasses");

    $Dataclasses = mysqli_fetch_all($ClassData, MYSQLI_ASSOC);

    $datas = mysqli_query($conn, "SELECT therapyClassId FROM therapyclasses");

    if (isset($_POST['submit'])) {
        $subTherapyClassName =  mysqli_real_escape_string($conn, $_POST['subTherapyClassName']);
        $therapyClassId = mysqli_real_escape_string($conn, $_POST['therapyClassId']);
        $results = mysqli_query($conn, "INSERT INTO subtherapyclasses(subTherapyClassName, therapyClassId) VALUES ('$subTherapyClassName', $therapyClassId)");

        header("Location: ../employee/kelas-obat.php");

        if (!$results) {
           echo "Error:". " " . mysqli_error($conn); 
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


  <?php include("../employee/template/header.php") ?>
    <div class="container mt-5">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputPassword4">Nama Sub-Kelas Terapi</label>
                <input type="text" name="subTherapyClassName" class="form-control" id="inputPassword4" placeholder="Nama Sub-Kelas Terapi">
            </div>
            <div class="form-group col-md-6">
            <label for="exampleInputEmail1">Turunan Kelas Terapi</label>
                <select class="form-control" name="therapyClassId">
                    <option value="" selected>Turunan Kelas Terapi</option>
                        <?php foreach($Dataclasses as $Dataclasses) :?>
                            <option value="<?php echo htmlspecialchars($Dataclasses['therapyClassId']); ?>"><?php echo htmlspecialchars($Dataclasses['therapyClassName']) ?></option>
                        <?php endforeach;?>
                </select>
            </div>

        </div>
        <a  href="../employee/kelas-obat.php" class="btn btn-primary back-btn">Kembali</a>

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