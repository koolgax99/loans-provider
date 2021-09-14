<?php
// Initialize session
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
	header('location: login.php');
	exit;
}

require_once "config/config.php";



if (isset($_SESSION['username'])) {
	/// your code here

	$username = $_SESSION['username'];





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

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
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

<body>
	<main>
		<section class="container wrapper">
			<div class="page-header">
				<h2 class="display-5">Welcome home <?php echo $_SESSION['username']; ?></h2>
			</div>

			<a href="password_reset.php" class="btn btn-block btn-outline-warning">Reset Password</a>
			<a href="logout.php" class="btn btn-block btn-outline-danger">Sign Out</a>
		</section>
	</main>
</body>

</html>