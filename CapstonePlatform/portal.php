<!DOCTYPE html>
<html >
<head>
	<!-- UI made with Mobirise-->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="generator" content="Mobirise v4.9.7, mobirise.com">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="shortcut icon" href="assets/images/uoit-rgb-primary-logo-1-216x121.jpg" type="image/x-icon">
	<meta name="description" content="Capstone Management">

	<title>Portal</title>
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
session_start();

// refirect to the home page if logged in already
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: /mob/index.php");
    exit;
}

require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(!empty(trim($_POST["username"])) && !empty(trim($_POST["password"])))
	{
		$password = sanitizeMySQL($link, $_POST["password"]);
		$username = sanitizeMySQL($link, $_POST["username"]);
		
		// check username and password in the database
        $sql = "SELECT username, password, permissions FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql))
		{
            mysqli_stmt_bind_param($stmt, "s", $username);

            if(mysqli_stmt_execute($stmt))
			{
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
				{                    
                    mysqli_stmt_bind_result($stmt, $username, $pass, $permissions);
                    
					if(mysqli_stmt_fetch($stmt))
					{
						// if password matches, save the session and redirect
						if(strcmp($password, $pass) == 0)
						{
							session_start();

							$_SESSION["loggedin"] = true;
							$_SESSION["perms"] = $permissions;
							$_SESSION["username"] = $username;                            

							header("location: /mob/profile.php");
						}
                    }
                } 
            } 
        }

        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($link);
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

<!-- login form -->
<section class="mbr-section form1 cid-rlT9qjCYQG" id="form1-16">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
					Portal Login
				</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-8" data-form-type="formoid">
				<?php
				// display error for bad login
				if(isset($_POST['username'])) 
				{
					echo "<div class='row row-sm-offset'>
							<div data-form-alert='' class='alert alert-danger col-12'>Invalid login credentials!</div>
						</div>";
				}
				?>
                <form action="portal.php" method="POST" class="mbr-form form-with-styler">
                    <div class="row row-sm-offset">
                        <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                        </div>
                    </div>
                    <div class="dragArea row row-sm-offset">
					    <div class="col-md-6  form-group" data-for="email">
                            <label for="email-form1-16" class="form-control-label mbr-fonts-style display-7">Email</label>
                            <input type="email" name="username" data-form-field="Email" required="required" class="form-control display-7" id="email-form1-16">
                        </div>
                        <div class="col-md-6  form-group" data-for="name">
                            <label for="name-form1-16" class="form-control-label mbr-fonts-style display-7">Password</label>
                            <input type="password" name="password" data-form-field="Name" required="required" class="form-control display-7" id="name-form1-16">
                        </div>
                        <div class="col-md-12 input-group-btn align-center"><button type="submit" class="btn btn-primary btn-form display-4">Login</button></div>
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
<script src="assets/theme/js/script.js"></script>

<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i></a></div>

</body>
</html>