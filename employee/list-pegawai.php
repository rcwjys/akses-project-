<?php 
  require '../config/connection.php';
  session_start();

  if (!$_SESSION['login']) {
    header("Location: ../index.php");
  }

  $fetchEmployee = mysqli_query($conn, "SELECT employeeId, employeeName, isAdmin, employeePassword FROM employees ORDER BY employeeName");



  if ( $isExist = mysqli_num_rows($fetchEmployee) !== 0) {
    $employees = mysqli_fetch_all($fetchEmployee, MYSQLI_ASSOC);
    $_SESSION['isEmployeeDetailProvided'] = true;
  } else {
    $_SESSION['isEmployeeDetailProvided'] = false;
    $_SESSION['manageEmployeeMessage'] = "Data karyawan tidak tersedia";
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

  <title>Pengelolaan Pegawai | UPTD Puskesmas Babakan Tarogong</title>


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
  
  <?php include "../employee/template/header.php"; ?>

  <main>
    <?php if($isExist) :?>
        <div class="container mt-5">
            <div class="card mx-auto" style="width: 60vw;">
                <div class="card-header text-center">
                    <h6>Data Pegawai</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Pegawai</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                            <?php $number = 1 ?>
                            <?php foreach($employees as $employee) : ?>
                                <tr>
                                    
                                    <th><?php echo $number?></th>
                                    <td>
                                        <?php echo ucfirst(htmlspecialchars($employee['employeeName'])) ?>
                                    </td>
                                    <td>
                                        <?php if($employee['isAdmin'] == 1) : ?>
                                            <?php echo htmlspecialchars("Admin") ?>
                                        <?php else: ?>
                                            <?php echo htmlspecialchars("Pegawai") ?>
                                        <?php endif;?>
                                    </td>
                                    <td>
                                        <a href="../employee/detail-pegawai.php?employeeId=<?php echo $employee['employeeId'] ?>" class="btn detail-button">Detail</a>
                                    </td>
                                    <?php $number++ ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container mt-5">
            <div class="card mx-auto" style="width: 60vw;">
                <div class="card-header text-center">
                    <h6>Data Pegawai</h6>
                </div>
                <h3 class="text-center py-5 px-5"><?php echo $_SESSION['manageEmployeeMessage']?></h3>
            </div>
        </div>
    <?php endif;?>
        
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
