<?php

session_start();

require_once "../config/connection.php";

if (!$_SESSION['login']) {
  header("Location: ../index.php");
}

$messageId = mysqli_real_escape_string($conn, $_GET['messageId']);

$getMessageQuery = "SELECT * FROM messages where messageId = $messageId";

$results = mysqli_query($conn, $getMessageQuery);

if (mysqli_num_rows($results) === 1) {
  $message = mysqli_fetch_assoc($results);
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

  <title>Detail Pesan | UPTD Puskesmas Babakan Tarogong</title>

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
  <div class="row">
    <div class="col-8 sender-information">
      <p class="sender mt-4">
        <?php echo "{$message['customerName']} | {$message['customerEmail']} | +62   {$message['customerPhoneNumber']}" ?>
      </p>
    </div>
    <div class="col-4">
      <p class="mt-4">
        <?php
        $timestamp = strtotime($message['created_at']);
        $date = date(' j F Y', $timestamp);
        $time = date('H:i', $timestamp);
        echo "{$date} | {$time}";
        ?>
      </p>
    </div>
    <hr>
    <div class="col-12">
      <?php echo "{$message['customerMessage']}" ?>
    </div>
  </div>

  <a type="button" class="btn back-btn mt-5" href="../employee/pesan.php">Kembali</a>
  <a type="button" class="btn back-btn mt-5 ml-3" target="_blank" href=<?php echo "mailto:" . $message['customerEmail'] . "?subject=no-reply-UPTD-Puskesmas-Babakan-Tarogong" ?>>Balas Via Email</a>

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