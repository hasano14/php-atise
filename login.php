<!DOCTYPE html>
<?php
  require_once('config.php');
  $db_host = $_ENV['DB_HOST'];
  $db_name = $_ENV['DB_NAME'];
  $db_user = $_ENV['DB_USER'];
  $db_password = $_ENV['DB_PASSWORD'];
  $db = new PDO('mysql:host=localhost;dbname=Fior_Website', 'root', '');
  
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //Get the email and password
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    //Prepare the SQL statement
    $stmt = $db->prepare("SELECT * FROM Login_Info WHERE email = :email AND password :password");

    //Execute the prepared statement
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    //Execute the statement
    $stmt->execute();

    //Check for existing user
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user){
      header("Location: dashboard.php");
      exit();
    } else {
      $error =  "Invalid email or password";
    }
  }
?>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content=""                               />
  <meta name="author" content="" />

  <title>Login | Fior</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Poppins:400,600,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">

  <div class="hero_area">
  <?php require_once('header.php'); ?>
  </div>


  <!-- login section -->

  <section class="contact_section layout_padding">
    <div class="container ">
      <div class="heading_container justify-content-center">
        <h2 class="">
          Login
        </h2>
      </div>

    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <form action="login.php" method="POST" onsubmit="return validateForm()">
            <div>
              <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required/>
            </div>
            <div>
              <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required />
              <span name="user-error" id="user-error" class="error-message"><?php echo isset($error) ? $error : ''; ?></span>
            </div>
            <div class="d-flex mt-4">
              <button type="submit">
                Login
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- end login section -->

  <!-- info section -->
  <section class="info_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="info_logo">
            <h5>
              Fior
            </h5>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
            </p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_links pl-lg-5">
            <h5>
              Useful Link
            </h5>
            <ul>
              <li>
                <a href="index.html">
                  Home
                </a>
              </li>
              <li>
                <a href="about.html">
                  About
                </a>
              </li>
              <li>
                <a href="gallery.html">
                  Gallery
                </a>
              </li>
              <li class="active">
                <a href="contact.html">
                  Contact Us
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_insta">
            <h5>
              Instagram
            </h5>
            <div class="insta_container">
              <div>
                <a href="">
                  <div class="insta-box b-1">
                    <img src="images/insta-1.png" alt="">
                  </div>
                </a>
                <a href="">
                  <div class="insta-box b-2">
                    <img src="images/insta-2.png" alt="">
                  </div>
                </a>
              </div>
              <div>
                <a href="">
                  <div class="insta-box b-3">
                    <img src="images/insta-3.png" alt="">
                  </div>
                </a>
                <a href="">
                  <div class="insta-box b-4">
                    <img src="images/insta-4.png" alt="">
                  </div>
                </a>
              </div>
              <div>
                <a href="">
                  <div class="insta-box b-3">
                    <img src="images/insta-5.png" alt="">
                  </div>
                </a>
                <a href="">
                  <div class="insta-box b-4">
                    <img src="images/insta-6.png" alt="">
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_contact">
            <h5>
              Contact
            </h5>
            <div>
              <img src="images/location-white.png" alt="">
              <p>
                It is a long
                fact that a reader
              </p>
            </div>
            <div>
              <img src="images/telephone-white.png" alt="">
              <p>
                +01 1234567890
              </p>
            </div>
            <div>
              <img src="images/envelope-white.png" alt="">
              <p>
                demo@gmail.com
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info_section -->

  <!-- footer section -->
  <footer class="container-fluid footer_section">
    <p>
      &copy; <span id="displayYear"></span> All Rights Reserved By
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </footer>
  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <script>
    function validateForm() {
      var emailInput = document.getElementById("email");
      var passwordInput = document.getElementById("password");
      var emailError = document.getElementById("email-error");

      //Validate email format using regular express:
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(emailInput.value)) {
        emailError.innerText = "Please enter a valid email address";
        passwordInput.focus();
        return false;
      }else{
        emailError.innerText = "";
        return true;
      }
    }
  </script>


</body>

</html>


