<?php
// Initialize sessions
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: welcome.php");
  exit;
}

// Include config file
require_once "config/config.php";

// Define variables and initialize with empty values
$username = $password = '';
$username_err = $password_err = '';

// Process submitted form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Check if username is empty
  if (empty(trim($_POST['username']))) {
    $username_err = 'Please enter username.';
  } else {
    $username = trim($_POST['username']);
  }

  // Check if password is empty
  if (empty(trim($_POST['password']))) {
    $password_err = 'Please enter your password.';
  } else {
    $password = trim($_POST['password']);
  }

  // Validate credentials
  if (empty($username_err) && empty($password_err)) {
    // Prepare a select statement
    $sql = 'SELECT id, email, password FROM customers WHERE email = ?';

    if ($stmt = $mysql_db->prepare($sql)) {

      // Set parmater
      $param_username = $username;

      // Bind param to statement
      $stmt->bind_param('s', $param_username);

      // Attempt to execute
      if ($stmt->execute()) {

        // Store result
        $stmt->store_result();

        // Check if username exists. Verify user exists then verify
        if ($stmt->num_rows == 1) {
          // Bind result into variables
          $stmt->bind_result($id, $username, $hashed_password);

          if ($stmt->fetch()) {
            if (password_verify($password, $hashed_password)) {

              // Start a new session
              session_start();

              // Store data in sessions
              $_SESSION['loggedin'] = true;
              $_SESSION['id'] = $id;
              $_SESSION['username'] = $username;

              // Redirect to user to page
              header('location: welcome.php');
            } else {
              // Display an error for passord mismatch
              $password_err = 'Invalid password';
            }
          }
        } else {
          $username_err = "Username does not exists.";
        }
      } else {
        echo "Oops! Something went wrong please try again";
      }
      // Close statement
      $stmt->close();
    }

    // Close connection
    $mysql_db->close();
  }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">


  <style>
    .login-container {
      margin-top: 5%;
      margin-bottom: 5%;
    }

    .login-form-1 {
      padding: 5%;
      box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
    }

    .login-form-1 h3 {
      text-align: center;
      color: #333;
    }

    .login-form-2 {
      padding: 5%;
      background: #0062cc;
      box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
    }

    .login-form-2 h3 {
      text-align: center;
      color: #fff;
    }

    .login-container form {
      padding: 10%;
    }

    .btnSubmit {
      width: 50%;
      border-radius: 1rem;
      padding: 1.5%;
      border: none;
      cursor: pointer;
    }

    .login-form-1 .btnSubmit {
      font-weight: 600;
      color: #fff;
      background-color: #0062cc;
    }

    .login-form-2 .btnSubmit {
      font-weight: 600;
      color: #0062cc;
      background-color: #fff;
    }

    .login-form-2 .ForgetPwd {
      color: #fff;
      font-weight: 600;
      text-decoration: none;
    }

    .login-form-1 .ForgetPwd {
      color: #0062cc;
      font-weight: 600;
      text-decoration: none;
    }
  </style>
  <!-- =======================================================
    Theme Name: Reveal
    Theme URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->

  <style>
    .wrapper {
      width: 500px;
      padding: 20px;
    }

    .wrapper h2 {
      text-align: center
    }

    .wrapper form .form-group span {
      color: red;
    }
  </style>

</head>

<body id="body">

  <!-- #header -->
  <?php include('includes/header.php'); ?>

  <main id="main">

    <section class="container wrapper">
      <h2 class="display-4 pt-3">Login</h2>
      <p class="text-center">Please fill this form to create an account.</p>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="form-group <?php (!empty($username_err)) ? 'has_error' : ''; ?>">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
          <span class="help-block"><?php echo $username_err; ?></span>
        </div>

        <div class="form-group <?php (!empty($password_err)) ? 'has_error' : ''; ?>">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
          <span class="help-block"><?php echo $password_err; ?></span>
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-block btn-outline-primary" value="Login">
        </div>
        <p>Don't have an account? <a href="register.php">Sign Up</a>.</p>
      </form>
    </section>


  </main>

  <!--==========================
    Footer
  ============================-->
  <?php include('includes/footer.php'); ?>
  <!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="lib/sticky/sticky.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</body>

</html>