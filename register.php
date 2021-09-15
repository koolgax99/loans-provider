<?php
// Include config file
session_start();


if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: welcome.php");
  exit;
}

require_once 'config/config.php';
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";

$f_name = $l_name = $user_email = $phone_no = $gender = $loc_state = $loc_district = $loc_city = $loc_pincode = "";
$dob = $qualifications = $bank = "";


$username_err = $password_err = $confirm_password_err = "";

// Process submitted form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Check if username is empty
  if (empty(trim($_POST['username']))) {
    $username_err = "Please enter a username.";

    // Check if username already exist
  } else {

    // Prepare a select statement
    $sql = 'SELECT id FROM customers WHERE email = ?';

    if ($stmt = $mysql_db->prepare($sql)) {
      // Set parmater
      $param_username = trim($_POST['username']);

      // Bind param variable to prepares statement
      $stmt->bind_param('s', $param_username);

      // Attempt to execute statement
      if ($stmt->execute()) {

        // Store executed result
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
          $username_err = 'This username is already taken.';
        } else {
          $username = trim($_POST['username']);
        }
      } else {
        echo "Oops! ${$username}, something went wrong. Please try again later.";
      }

      // Close statement
      // $stmt->close();
    } else {

      // Close db connction
      // $mysql_db->close();
    }
  }

  // Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have atleast 6 characters.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Please confirm password.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Password did not match.";
    }
  }




  $f_name = trim($_POST['fname']);
  $l_name = trim($_POST['lname']);
  $phone_no = trim($_POST['phoneno']);
  $gender = trim($_POST['gender']);
  $loc_state = trim($_POST['locstate']);
  $loc_district = trim($_POST['locdistrict']);
  $loc_city = trim($_POST['loccity']);
  $loc_pincode = trim($_POST['locpincode']);
  $dob = trim($_POST['dob']);
  $qualifications = trim($_POST['qualif']);
  $bank = trim($_POST['bank']);

  // Check input error before inserting into database

  if (empty($username_err) && empty($password_err) && empty($confirm_err)) {

    // Prepare insert statement
    $sql = 'INSERT INTO customers (f_name, l_name, email, password, phone, gender, city, district, pincode, state, date_of_birth, qualification, bank) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';

    if ($stmt = $mysql_db->prepare($sql)) {

      // Set parmater
      $param_username = $username;
      $param_password = password_hash($password, PASSWORD_DEFAULT); // Created a password

      // Bind param variable to prepares statement
      $stmt->bind_param('sssssssssssss', $f_name, $l_name, $param_username, $param_password, $phone_no, $gender, $loc_city, $loc_district, $loc_pincode, $loc_state, $dob, $qualifications, $bank);

      // Attempt to execute
      // echo $sql."<br>";

      // echo $f_name." ".$username." ".$param_password." ".$phone_no." ".$gender." ".$loc_city;


      if ($stmt->execute()) {
        // Redirect to login page
        header('location: ./login.php');
        // echo "Will  redirect to login page";
      } else {
        echo "Something went wrong. Try signing in again.";
      }

      // Close statement
      // $stmt->close();	
    }

    // Close connection
    // $mysql_db->close();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title> Loan Finance</title>
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

  <!-- =======================================================
    Theme Name: Reveal
    Theme URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body id="body">
  <!-- #header -->
  <?php include('includes/header.php'); ?>

  <main id="main" style="padding-top: 50px;">

    <div class="container">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <h2 class="text-center">Join Our Network</h2>
        <div class="row jumbotron">
          <div class="col-sm-6 form-group">
            <label for="name-f">First Name</label>
            <input type="text" class="form-control" name="fname" id="name-f" placeholder="Enter your first name." required>
          </div>
          <div class="col-sm-6 form-group">
            <label for="name-l">Last name</label>
            <input type="text" class="form-control" name="lname" id="name-l" placeholder="Enter your last name." required>
          </div>

          <div class="col-sm-6 form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="username" id="email" placeholder="Enter your email." required>
          </div>

          <div class="col-sm-6 form-group">
            <label for="tel">Phone</label>
            <input type="tel" name="phoneno" class="form-control" id="tel" placeholder="Enter Your Contact Number." required>
          </div>

          <div class="col-sm-6 form-group">
            <label for="sex">Gender</label>
            <select name="gender" id="sex" class="form-control browser-default custom-select">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="unspesified">Unspecified</option>
            </select>
          </div>

          <div class="form-group col-md-6">
            <label for="inputState">State</label>
            <select name="locstate" class="form-control" id="inputState" required>
              <option value="">Select State</option>
              <option value="Andra Pradesh">Andra Pradesh</option>
              <option value="Arunachal Pradesh">Arunachal Pradesh</option>
              <option value="Assam">Assam</option>
              <option value="Bihar">Bihar</option>
              <option value="Chhattisgarh">Chhattisgarh</option>
              <option value="Goa">Goa</option>
              <option value="Gujarat">Gujarat</option>
              <option value="Haryana">Haryana</option>
              <option value="Himachal Pradesh">Himachal Pradesh</option>
              <option value="Jammu and Kashmir">Jammu and Kashmir</option>
              <option value="Jharkhand">Jharkhand</option>
              <option value="Karnataka">Karnataka</option>
              <option value="Kerala">Kerala</option>
              <option value="Madya Pradesh">Madya Pradesh</option>
              <option value="Maharashtra">Maharashtra</option>
              <option value="Manipur">Manipur</option>
              <option value="Meghalaya">Meghalaya</option>
              <option value="Mizoram">Mizoram</option>
              <option value="Nagaland">Nagaland</option>
              <option value="Odisha">Odisha</option>
              <option value="Punjab">Punjab</option>
              <option value="Rajasthan">Rajasthan</option>
              <option value="Sikkim">Sikkim</option>
              <option value="Tamil Nadu">Tamil Nadu</option>
              <option value="Telangana">Telangana</option>
              <option value="Tripura">Tripura</option>
              <option value="Uttarakhand">Uttarakhand</option>
              <option value="Uttar Pradesh">Uttar Pradesh</option>
              <option value="West Bengal">West Bengal</option>
              <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
              <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
              <option value="Chandigarh">Chandigarh</option>
              <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
              <option value="Daman and Diu">Daman and Diu</option>
              <option value="Delhi">Delhi</option>
              <option value="Lakshadweep">Lakshadweep</option>
              <option value="Pondicherry">Pondicherry</option>
            </select>
          </div>

          <div class="form-group col-md-6">
            <label for="inputDistrict">District</label>
            <select name="locdistrict" class="form-control" id="inputDistrict" required>
              <option value="">-- select one -- </option>
            </select>
          </div>

          <div class="col-sm-6 form-group">
            <label for="address-2">City</label>
            <input type="address" class="form-control" name="loccity" id="address-2" placeholder="City Name." required>
          </div>

          <div class="col-sm-2 form-group">
            <label for="zip">Pin Code</label>
            <input type="zip" class="form-control" name="locpincode" id="zip" placeholder="Pin-Code." required>
          </div>

          <div class="col-sm-6 form-group">
            <label for="Date">Date Of Birth</label>
            <input type="Date" name="dob" class="form-control" id="Date" placeholder="" required>
          </div>


          <div class="col-md-6 form-group">
            <label>Qualification : </label>
            <select name="qualif" class="form-control">
              <option value="Non-metric">Non-metric</option>
              <option value="Metric">Metric</option>
              <option value="Intermediate">Intermediate </option>
              <option value="Gradutions">Gradutions</option>
              <option value="Post-Gradution">Post-Gradution</option>

            </select>
          </div>

          <div class="col-md-6 form-group">
            <label>Select Bank : </label>
            <select class='form-control' id='Highest_Qualification' name="bank" title='Highest Qualification' required="">
              <!--    <option selected="selected" value="Please select" disabled="">Please select</option>-->
              <option value="State Bank of India">State Bank of India</option>
              <option value="Punjab National Bank">Punjab National Bank</option>
              <option value="Bank of Baroda">Bank of Baroda</option>
              <option value="Bank of India">Bank of India</option>
              <option value="Central Bank of India">Central Bank of India</option>
              <option value="Canara Bank">Canara Bank</option>
              <option value="Allahabad Bank">Allahabad Bank</option>
              <option value="ICICI Bank">ICICI Bank</option>
              <option value="Axis Bank">Axis Bank</option>
              <option value="Bandhan Bank">Bandhan Bank</option>
              <option value="Union Bank of India">Union Bank of India</option>
              <option value="United Bank of India">United Bank of India</option>
              <option value="Uttar Bihar Gramin Bank">Uttar Bihar Gramin Bank</option>
              <option value="Madhya Bihar Gramin Bank">Madhya Bihar Gramin Bank</option>
              <option value="Canara Bank">Canara Bank</option>
              <option value="Bihar Kshetriya Gramin Bank">Bihar Kshetriya Gramin Bank</option>
              <option value="UCO Bank">UCO Bank</option>
              <option value="Indian Bank">Indian Bank</option>
              <option value="Others">Others</option>
            </select>
          </div>

          <div class="col-sm-6 form-group">
            <label for="pass">Password</label>
            <input type="Password" name="password" class="form-control" id="pass" placeholder="Enter your password." required>
          </div>
          <div class="col-sm-6 form-group">
            <label for="pass2">Confirm Password</label>
            <input type="Password" name="confirm_password" class="form-control" id="pass2" placeholder="Re-enter your password." required>
          </div>
          <div class="col-sm-12">
            <input type="checkbox" class="form-check d-inline" id="chb" required><label for="chb" class="form-check-label">&nbsp;I accept all terms and conditions.
            </label>
          </div>

          <div class="col-sm-12 form-group mb-0">
            <button class="btn btn-primary float-right">Submit</button>
          </div>

        </div>
      </form>
    </div>


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
  <script src="js/state_options.js"></script>

</body>

</html>