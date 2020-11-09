<!DOCTYPE html>
<html  >
<head>
  <!-- UI made with Mobirise-->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.9.7, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/uoit-rgb-primary-logo-1-216x121.jpg" type="image/x-icon">
  <meta name="description" content="Web Builder Description">
  
  <title>Contact</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
</head>

<?php
	require_once "config.php";
	
	$error = false;
	
	// check if inputs are set
	if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message'])) 
	{
        $error = true;     
    }
	
	// sanitize inputs
	$name = sanitizeMySQL($link, $_POST['name']);
	$email = sanitizeMySQL($link, $_POST['email']);
	$phone = sanitizeMySQL($link, $_POST['phone']);
	$message = sanitizeMySQL($link, $_POST['message']);
		
	// validate inputs
	$error_msg = "";
	if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 40) 
	{
		$error_msg = "Invalid email.<br/>"; 
	}
	
	if(isset($_POST['phone']) && !preg_match('/^\d{10}$/', $phone)) 
	{
		$error_msg .= 'Invalid phone number.<br/>';
	}
	
	if(strlen($message) < 5) 
	{
		$error_msg .= 'Message too short.<br/>';
	}
	
	if(strlen($message) > 500) 
	{
		$error_msg .= 'Message too long.<br/>';
	}
	
	if(strlen($name) > 40) 
	{
		$error_msg .= 'Name too long.<br/>';
	}
	
	if(strlen($name) < 3) 
	{
		$error_msg .= 'Name too short.<br/>';
	}
	
	if(!preg_match("/^[a-zA-Z ]*$/", $name))
	{
		$error_msg .= 'Invalid name.<br/>';
	}
		
	if(strlen($error_msg) > 0)
	{
		$error = true;
	}
	
	// if inputs are valid, insert them into the database
	if(!$error)
	{
		$stmt = $link->prepare("INSERT INTO messages (name, email, phone, message) VALUES (?, ?, ?, ?);");
		$stmt->bind_param("ssss", $name, $email, $phone, $message);

		$stmt->execute();
		$stmt->close();
	}
?>

<body>

<!--navigation menu-->
<section class="menu cid-rlSd2b5l0d" once="menu" id="menu1-0">
	<nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="index.php">
                         <img src="assets/images/ontariotechuniversity-primary-colour-rgb-150ppi-218x77.jpg" alt="Mobirise" title="" style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-4" href="">Capstone Assistance and Management Platform</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
				<li class="nav-item">
                    <a class="nav-link link text-black display-4" href="index.php">
                        <span class="mbri-home mbr-iconfont mbr-iconfont-btn"></span>
                        Home
					</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-black display-4" href="about.php">
                        <span class="mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                        About
					</a>
                </li>
				<li class="nav-item"><a class="nav-link link text-black display-4" href="archive.php">
					<span class="mbri-database mbr-iconfont mbr-iconfont-btn"></span>
                        Archive
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link link text-black display-4" href="contact.php">
						<span class="mbri-letter mbr-iconfont mbr-iconfont-btn"></span>
						Contact
					</a>
				</li>
				<?php
					session_start();

					// only add project ideas, logout and profile if logged in
					if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
					{
						echo "<li class='nav-item'>
								<a class='nav-link link text-black display-4' href='projectIdeas.php'>
								<span class='mbri-idea mbr-iconfont mbr-iconfont-btn'>
								</span>Project Ideas</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link link text-black display-4' href='profile.php'>
									<span class='mbri-user mbr-iconfont mbr-iconfont-btn'></span>
									Profile
								</a>
							</li>";
							
						// if the user is admin, add an admin option
						if($_SESSION["perms"] && intval($_SESSION["perms"]) == 2)
						{
							echo "<li class='nav-item'>
								<a class='nav-link link text-black display-4' href='admin.php'>
									<span class='mbri-edit mbr-iconfont mbr-iconfont-btn'></span>
									Admin
								</a>
							</li>";
						}
						
						echo "<li class='nav-item'>
								<a class='nav-link link text-black display-4' href='logout.php'>
									<span class='mbri-logout mbr-iconfont mbr-iconfont-btn'></span>
									Logout
								</a>
							</li>";
					}
					else
					{
						echo "<li class='nav-item'>
								<a class='nav-link link text-black display-4' href='portal.php'>
									<span class='mbri-user mbr-iconfont mbr-iconfont-btn'></span>
									Login
								</a>
							</li>";
					}
				?>	
			</ul>
        </div>
    </nav>
</section>

<!-- header for the content -->
<section class="header1 cid-rlT6RAOQOn mbr-parallax-background" id="header1-15">
    <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(0, 119, 202);"></div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title align-center mbr-bold pb-3 mbr-fonts-style display-1">Contact Course Coordinator</h1>
            </div>
        </div>
    </div>
</section>

<!-- contact form -->
<section class="mbr-section form1 cid-rlT4D7KDli" id="form1-14">
    <div class="container">
        <div class="row justify-content-center">
			<div class="media-container-column col-lg-8">
				<?php
				// display an error or success message if inputs are valid
				if(isset($_POST['email']) && !$error) 
				{
					echo "<div class='row row-sm-offset'>
							<div data-form-alert='' class='alert alert-success col-12'>Thank you for the message!</div>
						</div>";
				}
				else if(isset($_POST['email']) && $error) 
				{
					echo "<div class='row row-sm-offset'>
							<div data-form-alert='' class='alert alert-danger col-12'>" . $error_msg . "</div>
						</div>";
				}
				?>
				<form id="contact-form" method="POST" action="contact.php">
					<div class="dragArea row row-sm-offset">
						<div class="col-md-4  form-group">
							<label for="name-form1-14" class="form-control-label mbr-fonts-style display-7">Name</label>
							<input class="form-control display-7" type="text" name="name" required="required"/>
						</div>
						<div class="col-md-4  form-group">
							<label for="email-form1-14" class="form-control-label mbr-fonts-style display-7">Email</label>
							<input class="form-control display-7" type="text" name="email" required="required"/>
						</div>
						<div class="col-md-4  form-group">
							 <label for="phone-form1-14" class="form-control-label mbr-fonts-style display-7">Phone (Optional)</label>
							<input class="form-control display-7" type="text" name="phone"/>
						</div>
						<div class="col-md-12  form-group">
							<label for="message-form1-14" class="form-control-label mbr-fonts-style display-7">Message</label>
							<textarea class="form-control display-7" name="message"></textarea>
						</div>
						<div class="col-md-12 input-group-btn align-center">
							<button type="submit" class="btn btn-primary btn-form display-4">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>
</section>

<!-- footer -->
<section once="footers" class="cid-rlSXfR4HtF" id="footer7-z">
    <div class="container">
        <div class="media-container-row align-center mbr-white">
            <div class="row row-links">
                <ul class="foot-menu">
					<li class="foot-menu-item mbr-fonts-style display-7">
						<a class="text-white mbr-bold" href="index.php">
							Home
						</a>
					</li>
					<li class="foot-menu-item mbr-fonts-style display-7">
						<a class="text-white mbr-bold" href="contact.php">
							Contact
						</a>
					</li>
				</ul>
            </div>
            <div class="row row-copirayt">
                <p class="mbr-text mb-0 mbr-fonts-style mbr-white align-center display-7">
                    © University of Ontario Institute of Technology 2019
                </p>
            </div>
        </div>
    </div>
</section>

<script src="assets/web/assets/jquery/jquery.min.js"></script>
<script src="assets/popper/popper.min.js"></script>
<script src="assets/tether/tether.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="assets/parallax/jarallax.min.js"></script>
<script src="assets/theme/js/script.js"></script>
<script src="assets/formoid/formoid.min.js"></script>
<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i></a></div>

</body>
</html>