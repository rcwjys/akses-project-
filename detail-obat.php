<?php 

    require("../mico-html/config/connection.php");

    session_start();

    if (!($_SESSION['isCanViewDetail'])) {
        header("Location: ../mico-html/persediaan-obat.php");
    }

    if (isset($_SESSION['login'])) {
        header('Location: ../mico-html/employee/index.php');
    }

    $medicineId = mysqli_real_escape_string($conn, $_GET['medicineId']);

    $sql = "SELECT medicineId, medicineName, medicineStock, medicineInformation FROM medicines where medicineId = $medicineId";

    $results = mysqli_query($conn, $sql);

    if ($results) {
        if (mysqli_num_rows($results) === 1) {
            $medicine = mysqli_fetch_assoc($results);
        } else {
            echo "Obat tidak ditemukan";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_free_result($results);

    mysqli_close($conn);

    

    


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

        <title>Detail Obat | UPTD Puskesmas Babakan Tarogong</title>


        <!-- bootstrap core css -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
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
        <link href="css/style.css" rel="stylesheet" />
        <!-- responsive style -->
        <link href="css/responsive.css" rel="stylesheet" />
    </head>

    <?php include("../mico-html/template/header.php") ?>

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
                            <tr></tr>
                                <th scope="row">Stok Obat Tersisa</th>
                                <td>:</td>
                                <td><?php echo htmlspecialchars($medicine['medicineStock']) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Informasi Obat</th>
                                <td>:</td>
                                <td><?php echo htmlspecialchars($medicine['medicineInformation']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <a type="button" class="btn mt-5 mx-3 my-3 back-btn" href="../mico-html/persediaan-obat.php">Kembali</a>
                </div>
            </div>
        </div>
    </main>
  


    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
    
    <!-- footer section -->
    <?php include("../mico-html/template/footer.php"); ?>
    <!-- footer section -->