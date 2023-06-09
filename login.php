<!DOCTYPE html>

<?php
require_once('config.php');
try {
  $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

//Check if the session has started and if the session has start, redirect the login.php to index.php
if (isset($_SESSION['email'])) {
  header("Location: index.php");
  exit();
}


//Check if the login form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //Get the email and password
  $email = $_POST['email'];
  $password = $_POST['password'];

  //Prepare the SQL statement
  $result = $db->prepare("SELECT * FROM login_info" . " WHERE email = :email");

  //Bind the parameters
  $result->bindParam(':email', $email);

  //Execute the statement
  $result->execute();

  if (!$result) {
    die('There was an error running the query [' . $db->errorInfo() . ']');
  }

  //Check for existing user
  $user = $result->fetch(PDO::FETCH_ASSOC);

  /* ` = password_hash(, PASSWORD_DEFAULT);` is hashing the user's password
  using the PHP `password_hash()` function with the default algorithm. This is a security measure to
  protect the user's password in case the database is compromised. The hashed password is then
  stored in the database for future authentication. */
  $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
  if ($user && password_verify($password, $hashedpassword)) {
    $_SESSION['email'] = $email;
    session_start();
    echo '<div class="popup"><h3>Login Successful</h3></div>';
    header("Location: index.php");
    exit();
  } else {
    $error = "Invalid password";
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
  <meta name="description" content="" />
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
  <style>
    .popup {
      position:fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: #fff;
      padding: 20px;
      z-index: 9999;
      border: 1px solid #000;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }
  </style>
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
              <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required />
            </div>
            <div>
              <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required />
              <span name="user-error" id="user-error" class="error-message" style="color:red; padding-left: 8px;"><?php echo isset($error) ? $error : ''; ?></span>
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
  <?php require_once('info.php'); ?>
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
      var emailError = document.getElementById("user-error");

      //Validate email format using regular express:
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(emailInput.value)) {
        emailError.innerText = "Invalid Email Or Password";
        return false;
      } else {
        emailError.innerText = "";
      }
      return true;
    }
  </script>
</body>

</html>