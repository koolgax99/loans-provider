<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(0);
?>
<!--==========================
    Top Bar
  ============================-->
<section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
        <div class="contact-info float-left">
            <i class="fa fa-envelope-o"></i>
            <a href="mailto:contact@example.com">contact@example.com</a>
            <i class="fa fa-phone"></i> +1 5589 55488 55
        </div>
        <div class="social-links float-right">
            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
            <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                echo "<a href='welcome.php'>"
                    . $_SESSION['username'] . "</a>";
            } ?>
        </div>
    </div>
</section>

<!--==========================
    Header
  ============================-->
<header id="header">
    <div class="container">
        <div id="logo" class="pull-left">
            <h1>
                <a href="#body" class="scrollto"><span>Consultants</span></a>
            </h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else { ?>
                    <!-- <button class="btn btn-primary my-2 my-sm-0" type="submit">Login</button> -->
                    <li><a href="register.php">Apply</a></li>
                    <li><a href="login.php">Login</a></li>
                <?php } ?>
            </ul>
        </nav>
        <!-- #nav-menu-container -->
    </div>
</header>
<!-- #header -->