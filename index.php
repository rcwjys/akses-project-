<?php 
require("../mico-html/config/connection.php");

    session_start();

    if (isset($_SESSION['login'])) {
      header("Location: ../mico-html/employee/index.php");
    }

    $errorMessage = ['fullname' => '', 'email' => '', 'phoneNumber' => '', 'message' => ''];

    if (isset($_POST['send'])) {

        $custFullName = mysqli_real_escape_string($conn, $_POST['fullname']);

        $custEmail = mysqli_real_escape_string($conn, $_POST['email']);

        $custPhoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);

        $customerMessage = mysqli_real_escape_string($conn, $_POST['message']);

        // Check customer fullname
        if (empty($custFullName)) {
          $errorMessage['fullname'] = "Nama lengkap tidak boleh kosong";
        }

        // Check customer email
        if (empty($custEmail)) {
          $errorMessage['email'] = "Email tidak boleh kosong";
        }else {
          if (!filter_var($custEmail, FILTER_VALIDATE_EMAIL)) {
            $errorMessage['email'] = "Email yang digunakan tidak valid";
          }
        }

        // check customer phoneNumber
        if (empty($custPhoneNumber)) {
          $errorMessage['phoneNumber'] = "No Telepon tidak boleh kosong";
        } else {
          if (!preg_match("/^[0-9]+$/", $custPhoneNumber)) {
            $errorMessage['phoneNumber'] = "No telepon harus berisi angka";
          }else {
            if (!preg_match("/^\d{12,}$/", $custPhoneNumber)) {
              $errorMessage['phoneNumber'] = "No Telepon minimal memiliki 12 digit angka";
            }
          }
        }

        // check customer message
        if (empty($customerMessage)) {
          $errorMessage['message'] = "Pesan tidak boleh kosong";
        }


        if (!array_filter($errorMessage)) {
            $sql = "INSERT INTO messages (customerName, customerEmail, customerPhoneNumber, customerMessage) VALUES ('$custFullName', '$custEmail', '$custPhoneNumber', '$customerMessage')";

            $results = mysqli_query($conn, $sql);

            if ($results) {
                header("Location: index.php");
            } else {
                echo "Error:" . $mysqli_error($conn);
            }
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

  <title>Beranda | UPTD Puskesmas Babakan Tarogong</title>


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



  <div class="hero_area">

    <?php include("../mico-html/template/header.php") ?>

    <!-- slider section -->
    <section class="slider_section ">
      <div class="dot_design">
        <img src="images/dots.png" alt="">
      </div>
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <div class="play_btn">
                      <button>
                        <i class="fa fa-play" aria-hidden="true"></i>
                      </button>
                    </div>
                    <h1>
                    Aplikasi Kendali Perbekalan Kesehatan <br>
                      <span>
                        AKSES
                      </span>
                    </h1>
                    <p>
                      when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to
                    </p>
                    <a href="">
                      Hubungi Kami
                    </a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <div class="play_btn">
                      <button>
                        <i class="fa fa-play" aria-hidden="true"></i>
                      </button>
                    </div>
                    <h1>
                    Aplikasi Kendali Perbekalan Kesehatan <br>
                      <span>
                        AKSES
                      </span>
                    </h1>
                    <p>
                      when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to
                    </p>
                    <a href="">
                      Hubungi Kami
                    </a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <div class="play_btn">
                      <button>
                        <i class="fa fa-play" aria-hidden="true"></i>
                      </button>
                    </div>
                    <h1>
                    Aplikasi Kendali Perbekalan Kesehatan <br>
                      <span>
                        AKSES
                      </span>
                    </h1>
                    <p>
                      when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to
                    </p>
                    <a href="">
                      Hubungi Kami
                    </a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.jpg">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
            <img src="images/prev.png" alt="">
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
            <img src="images/next.png" alt="">
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>


  <!-- about section -->
  <section class="book_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col">
          <section class="about_section">
            <div class="container  ">
              <div class="row">
                <div class="col-md-6 ">
                  <div class="img-box">
                    <img src="images/about-img.jpg" alt="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="detail-box">
                    <div class="heading_container">
                      <h2>
                        About <span>AKSES</span>
                      </h2>
                    </div>
                    <p>
                      has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors
                    </p>
                    <a href="">
                      Baca Selanjutnya
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
  <!-- end about section -->

<!-- contact section -->
<section class="contact_section layout_padding-bottom" id="kontak">
    <div class="container">
      <div class="heading_container">
        <h2>
          Get In <span>Touch</span>
        </h2>
      </div>
      <div class="row">
        <div class="col-md-7">
          <div class="form_container">
            <form action="" method="POST">
              <div>
                <input type="text" name="fullname" placeholder="Nama Lengkap" autocomplete="off"/>
                <p class="text-danger"><?php echo $errorMessage['fullname']?></p>
              </div>
              <div>
                <input type="email" name="email" placeholder="Email" autocomplete="off"/>
                <p class="text-danger"><?php echo $errorMessage['email']?></p>
              </div>
              <div>
                <input type="text" name="phoneNumber" placeholder="No Telepon (+62)" autocomplete="off"/>
                <p class="text-danger"><?php echo $errorMessage['phoneNumber']?></p>
              </div>
              <div>
                <input type="text" name="message" class="message-box" placeholder="Pesan" autocomplete="off"/>
                <p class="text-danger"><?php echo $errorMessage['message']?></p>
              </div>
              <div class="btn_box">
                <button type="submit" name="send" class="submit-message-button">
                  Kirim
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-5">
          <div class="img-box">
            <img src="images/contact-img.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->

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




