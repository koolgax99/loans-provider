<?php
// Initialize session
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
	header('location: login.php');
	exit;
}

require_once "config/config.php";

$reg_no
=$f_name
=$l_name
=$father_name
=$gender
=$adhaar_number
=$pan_number
=$village
=$date_of_birth
=$city
=$organization
=$pincode
=$account_no
=$ifsc_code
=$reg_fee
=$reg_status
=$loan_amount
=$loan_period
=$monthly_emi
=$rate
=$verified = "";

if (isset($_SESSION['username'])) {
	/// your code here

	$username = $_SESSION['username'];





	$sql = 'SELECT reg_no,
	f_name,
	l_name,
	father_name,
	gender,
	adhaar_number,
	pan_number,
	village,
	date_of_birth,
	city,
	organization,
	pincode,
	account_no,
	ifsc_code,
	reg_fee,
	reg_status,
	loan_amount,
	loan_period,
	monthly_emi,
	rate,
	verified

	FROM customers WHERE email = ?';

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
				// $stmt->bind_result($id, $username, $hashed_password);

				$stmt->bind_result($reg_no,
				$f_name,
				$l_name,
				$father_name,
				$gender,
				$adhaar_number,
				$pan_number,
				$village,
				$date_of_birth,
				$city,
				$organization,
				$pincode,
				$account_no,
				$ifsc_code,
				$reg_fee,
				$reg_status,
				$loan_amount,
				$loan_period,
				$monthly_emi,
				$rate,
				$verified);





				if ($stmt->fetch()) {
					
					// echo "Data Retrieved";
				}
			} else {
				// $username_err = "Username does not exists.";
				header('location: login.php');
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


  <style>
    .login-container{
    margin-top: 5%;
    margin-bottom: 5%;
}
.login-form-1{
    padding: 5%;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-1 h3{
    text-align: center;
    color: #333;
}
.login-form-2{
    padding: 5%;
    background: #0062cc;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-2 h3{
    text-align: center;
    color: #fff;
}
.login-container form{
    padding: 10%;
}
.btnSubmit
{
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    border: none;
    cursor: pointer;
}
.login-form-1 .btnSubmit{
    font-weight: 600;
    color: #fff;
    background-color: #0062cc;
}
.login-form-2 .btnSubmit{
    font-weight: 600;
    color: #0062cc;
    background-color: #fff;
}
.login-form-2 .ForgetPwd{
    color: #fff;
    font-weight: 600;
    text-decoration: none;
}
.login-form-1 .ForgetPwd{
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
</head>

<body id="body">

  <?php include('includes/header.php'); ?>

  <main id="main">

    <section id="about" class="wow fadeInUp">
      <div class="container">

          <div>
            <div class="text-center about-head">
              <h3>Profile Details</h3>
            </div>

            <div style="display: block;">
              <a href="logout.php" class="btn btn-primary float-right" role="button">Logout</a>
            </div>

          </div>

          <div style="display: inline-block;">
            <div class="alert alert-success" role="alert">
              <span style="margin-right: 30px;">Last Login: 16/05/2021 09:10:56 PM</span>
              <span style="margin-right: 30px;">Current Login: 16/05/2021 09:15:50 PM</span>
              <span style="margin-right: 30px;">16/05/2021</span>
              <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
            </div>
          </div>


          <table class="table table-bordered">
            <tbody>
              <tr>
                <!-- <td colspan="3" style="text-align: center;">Online All Indian Loans Provider</td> -->
                <td colspan="4" style="text-align: center;">
                  <img src="img/apple-touch-icon.png" class="img-fluid" alt="Sheep" style="max-width: 100px;">
                </td>
              </tr>

              <tr>
                <td colspan="4" style="text-align: center;font-weight: bold;">Online All Indian Loans Provider</td>
              </tr>

              <tr>
                <!-- <th scope="row">2</th> -->
                <td>Registration No.</td>
                <td colspan="2"> <?php echo $reg_no ?> </td>
                <!-- <td>@fat</td> -->
                <td rowspan="5" style="text-align: center;">
                  <img src="img/profile-sample.png" class="img-fluid" alt="Sheep" style="max-height: 150px;">
                </td>
              </tr>

              <tr>
                <td>Applicant name</td>
                <td colspan="2"> <?php echo $f_name." ".$l_name ?> </td>
              </tr>

              <tr>
                <td>Father Name/Husband Name</td>
                <td colspan="2"> <?php echo $father_name ?> </td>
              </tr>

              <tr>
                <td>Gender</td>
                <td colspan="2"> <?php echo $gender ?> </td>
              </tr>

              <tr>
                <td>Aadhaar Number</td>
                <td colspan="2"> <?php echo $adhaar_number ?> </td>
              </tr>

            </tbody>
          </table>


          <table class="table table-bordered">
            <tbody>

              <tr>
                <td>PAN NUMBER</td>
                <td> <?php echo $pan_number ?> </td>
                <td>Village/Town</td>
                <td> <?php echo $village?> </td>
              </tr>

              <tr>
                <td>Date of Birth</td>
                <td> <?php echo $date_of_birth ?> </td>
                <td>City/District</td>
                <td><?php echo $city ?></td>
              </tr>

              <tr>
                <td>Organization/Firm Name</td>
                <td> <?php echo $organization ?> </td>
                <td>Pin Code</td>
                <td> <?php echo $pincode ?> </td>
              </tr>

            </tbody>

          </table>


          <table class="table table-bordered">
            <tbody>

              <tr>
                <td>Bank Account</td>
                <td> <?php echo $account_no ?> </td>
              </tr>

              <tr>
                <td>IFSC Code</td>
                <td> <?php echo $ifsc_code ?> </td>
              </tr>

              <tr>
                <td>Registration Fee</td>
                <td> <?php echo $reg_fee ?> </td>
              </tr>

              <tr>
                <td>Registration Status</td>
                <td> <?php echo $reg_status ?> </td>
              </tr>

              <tr>
                <td>Loan Amount</td>
                <td> <?php echo $loan_amount ?> </td>
              </tr>

              <tr>
                <td>Loan Period</td>
                <td> <?php echo $loan_period ?> </td>
              </tr>

              <tr>
                <td>Monthly EMI</td>
                <td> <?php echo $monthly_emi ?> </td>
              </tr>

              <tr>
                <td>Interest Rate</td>
                <td>  <?php 
				
				if($rate!="-")
				{
					echo $rate."%";
				}
				echo $rate;
				?>  </td>
              </tr>


			  <tr>
                <td>STATUS</td>
                
				<?php
					if($verified=="1")
					{
						echo "<td style=\"color: #4CAF50;\">
						VERIFIED
					  </td>";
					}
					else
					{
						echo "<td style=\"color:#CC6600\">
						PENDING</td>";
					}
				?>
              </tr>

            </tbody>

          </table>


      </div>
    </section><!-- #about -->



  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Loan Finance</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
        -->
         
    </div>
  </footer><!-- #footer -->

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
